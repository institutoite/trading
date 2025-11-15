<?php

namespace App\Services;

use App\Models\BlueExchangeRate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BlueRateUpdater
{
    // Única fuente estable por ahora
    private array $sources = [
        'https://rates.airtm.io/'
    ];

    // Cada cuántos minutos tomar snapshot si no cambió
    private int $snapshotEveryMinutes = 60;

    public function fetchAndStore(bool $forceSnapshot = false): bool
    {
        $now  = Carbon::now('America/La_Paz');
        $date = $now->toDateString();
        $saved = false;

        foreach ($this->sources as $source) {
            $json = $this->get($source);
            if (!$json) { Log::warning("BlueRateUpdater: sin datos {$source}"); continue; }

            // Normalizar payload: Airtm devuelve { data: { 'bob/usd': {...} } }
            $payload = (isset($json['data']) && is_array($json['data'])) ? $json['data'] : $json;

            [$buy, $sell] = $this->extractFromAirtm($payload);
            if ($buy === null || $sell === null) {
                Log::warning('BlueRateUpdater: no se encontró par bob/usd ni variantes');
                continue;
            }

            $lastBuy  = BlueExchangeRate::where('date',$date)->where('type','buy')->where('source',$source)->latest()->first();
            $lastSell = BlueExchangeRate::where('date',$date)->where('type','sell')->where('source',$source)->latest()->first();

            $buyChanged  = !$lastBuy  || (float)$lastBuy->rate  !== (float)$buy;
            $sellChanged = !$lastSell || (float)$lastSell->rate !== (float)$sell;

            $needSnapshot = $forceSnapshot || $this->needsSnapshot($lastBuy, $lastSell, $now);

            if ($buyChanged || $sellChanged || $needSnapshot) {
                BlueExchangeRate::create(['date'=>$date,'source'=>$source,'rate'=>$buy,'type'=>'buy']);
                BlueExchangeRate::create(['date'=>$date,'source'=>$source,'rate'=>$sell,'type'=>'sell']);
                $saved = true;
                Log::info("BlueRateUpdater: guardado buy={$buy} sell={$sell} force={$forceSnapshot}");
            }
        }

        // Fallback: si forzaste y no pudiste guardar, usa último conocido
        if (!$saved && $forceSnapshot) {
            $saved = $this->snapshotFromLastKnown($date);
        }

        return $saved;
    }

    private function needsSnapshot($lastBuy, $lastSell, Carbon $now): bool
    {
        $threshold = $now->copy()->subMinutes($this->snapshotEveryMinutes);
        if (!$lastBuy || !$lastSell) return true;
        return $lastBuy->created_at->lt($threshold) || $lastSell->created_at->lt($threshold);
    }

    private function get(string $url): ?array
    {
        try {
            $verify = filter_var(env('BLUE_HTTP_VERIFY', false), FILTER_VALIDATE_BOOLEAN);
            $r = Http::timeout(12)->withOptions(['verify'=>$verify])->get($url);
            return $r->ok() ? $r->json() : null;
        } catch (\Throwable $e) {
            Log::error("HTTP {$url}: ".$e->getMessage());
            return null;
        }
    }

    // Extrae compra/venta desde el payload de Airtm (data['bob/usd'])
    private function extractFromAirtm(array $data): array
    {
        // Preferido
        foreach (['bob/usd','BOB/USD'] as $k) {
            if (isset($data[$k]['addValue'], $data[$k]['withdrawValue'])) {
                return [(float)$data[$k]['addValue'], (float)$data[$k]['withdrawValue']];
            }
        }
        // Alternativas (no debería ser necesario, pero por si cambia)
        foreach (['usd/bob','USD/BOB'] as $k) {
            if (isset($data[$k]['addValue'], $data[$k]['withdrawValue'])) {
                return [(float)$data[$k]['addValue'], (float)$data[$k]['withdrawValue']];
            }
        }
        return [null, null];
    }

    private function snapshotFromLastKnown(string $date): bool
    {
        $lastKnownBuy  = BlueExchangeRate::where('type','buy')->latest()->first();
        $lastKnownSell = BlueExchangeRate::where('type','sell')->latest()->first();
        if (!$lastKnownBuy || !$lastKnownSell) return false;

        BlueExchangeRate::create(['date'=>$date,'source'=>'fallback:last-known','rate'=>$lastKnownBuy->rate,'type'=>'buy']);
        BlueExchangeRate::create(['date'=>$date,'source'=>'fallback:last-known','rate'=>$lastKnownSell->rate,'type'=>'sell']);
        Log::info('Fallback: snapshot desde último conocido');
        return true;
    }
}