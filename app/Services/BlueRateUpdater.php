<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Models\BlueExchangeRate;

class BlueRateUpdater
{
    private array $sources = [
        'https://www.dolarbluebolivia.click/api/exchange_currencies',
        'https://rates.airtm.io/'
    ];

    // minutos para tomar snapshot si no cambia
    private int $snapshotEveryMinutes = 60;

    public function fetchAndStore(bool $forceSnapshot = false): bool
    {
        $date = Carbon::now('America/La_Paz')->toDateString();
        $changedOrSaved = false;

        foreach ($this->sources as $source) {
            $data = $this->get($source);
            if (!$data) {
                Log::warning("BlueRateUpdater: sin datos de {$source}");
                continue;
            }

            $buy = null; $sell = null;
            if (str_contains($source, 'dolarbluebolivia')) {
                if (isset($data['blue']['buy'], $data['blue']['sell'])) {
                    $buy = $data['blue']['buy'];
                    $sell = $data['blue']['sell'];
                }
            } elseif (str_contains($source, 'airtm')) {
                if (isset($data['bob/usd']['addValue'], $data['bob/usd']['withdrawValue'])) {
                    $buy = $data['bob/usd']['addValue'];
                    $sell = $data['bob/usd']['withdrawValue'];
                }
            }

            if ($buy === null || $sell === null) {
                Log::warning("BlueRateUpdater: estructura inválida en {$source}");
                continue;
            }

            $lastBuy = BlueExchangeRate::where('date', $date)->where('type','buy')->where('source',$source)->latest()->first();
            $lastSell = BlueExchangeRate::where('date', $date)->where('type','sell')->where('source',$source)->latest()->first();

            $buyChanged = !$lastBuy || $lastBuy->rate != $buy;
            $sellChanged = !$lastSell || $lastSell->rate != $sell;
            $needSnapshot = $forceSnapshot || $this->needsSnapshot($lastBuy, $lastSell);

            if ($buyChanged || $sellChanged || $needSnapshot) {
                BlueExchangeRate::create(['date'=>$date,'source'=>$source,'rate'=>$buy,'type'=>'buy']);
                BlueExchangeRate::create(['date'=>$date,'source'=>$source,'rate'=>$sell,'type'=>'sell']);
                $changedOrSaved = true;
                Log::info("BlueRateUpdater: guardado {$source} buy={$buy} sell={$sell} force={$forceSnapshot}");
            }
        }

        // Fallback: si no se pudo guardar nada (APIs caídas), usar último valor conocido
        if (!$changedOrSaved && $forceSnapshot) {
            $changedOrSaved = $this->snapshotFromLastKnown($date);
        }

        return $changedOrSaved;
    }

    private function needsSnapshot($lastBuy, $lastSell): bool
    {
        $threshold = Carbon::now('America/La_Paz')->subMinutes($this->snapshotEveryMinutes);
        if (!$lastBuy || !$lastSell) return true;
        return $lastBuy->created_at->lt($threshold) || $lastSell->created_at->lt($threshold);
    }

    private function get(string $url): ?array
    {
        try {
            $verify = filter_var(env('BLUE_HTTP_VERIFY', false), FILTER_VALIDATE_BOOLEAN);
            $r = Http::timeout(12)->withOptions(['verify' => $verify])->get($url);
            return $r->ok() ? $r->json() : null;
        } catch (\Throwable $e) {
            Log::error("HTTP error {$url}: ".$e->getMessage());
            return null;
        }
    }

    private function snapshotFromLastKnown(string $date): bool
    {
        $lastKnownBuy = BlueExchangeRate::where('type','buy')->latest()->first();
        $lastKnownSell = BlueExchangeRate::where('type','sell')->latest()->first();
        if (!$lastKnownBuy || !$lastKnownSell) {
            Log::warning('Fallback: no hay último conocido para snapshot');
            return false;
        }
        BlueExchangeRate::create([
            'date'=>$date, 'source'=>'fallback:last-known', 'rate'=>$lastKnownBuy->rate, 'type'=>'buy'
        ]);
        BlueExchangeRate::create([
            'date'=>$date, 'source'=>'fallback:last-known', 'rate'=>$lastKnownSell->rate, 'type'=>'sell'
        ]);
        Log::info('Fallback: snapshot creado desde último conocido');
        return true;
    }
}