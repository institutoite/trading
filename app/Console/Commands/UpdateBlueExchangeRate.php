<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BlueExchangeRate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class UpdateBlueExchangeRate extends Command
{
    protected $signature = 'blue-rate:update';
    protected $description = 'Actualiza el tipo de cambio blue desde varias fuentes y guarda el promedio';

    protected $sources = [
        'https://www.dolarbluebolivia.click/api/exchange_currencies',
        'https://rates.airtm.io/',
    ];

    public function handle()
    {
    $date = Carbon::now('America/La_Paz')->toDateString();
        $rates = [];

        foreach ($this->sources as $source) {
            $apiData = $this->fetchApiData($source);
            if ($apiData && is_array($apiData)) {
                // Si es la API de DolarBlueBolivia.click, registrar todas las monedas
                if (str_contains($source, 'dolarbluebolivia.click')) {
                    foreach ($apiData as $currency => $values) {
                        if (is_array($values)) {
                            foreach (['buy', 'sell'] as $type) {
                                if (isset($values[$type]) && $values[$type] > 0) {
                                    \App\Models\CurrencyExchangeRate::updateOrCreate([
                                        'date' => $date,
                                        'currency' => $currency,
                                        'type' => $type,
                                    ], [
                                        'rate' => $values[$type],
                                        'created_at' => Carbon::now('America/La_Paz'),
                                        'updated_at' => Carbon::now('America/La_Paz'),
                                    ]);
                                    // Si es blue, guardar también en BlueExchangeRate con type
                                    if ($currency === 'blue') {
                                        $lastBuy = BlueExchangeRate::where([
                                            ['date', '=', $date],
                                            ['source', '=', $source],
                                            ['type', '=', 'buy'],
                                        ])->orderByDesc('created_at')->first();
                                        $lastSell = BlueExchangeRate::where([
                                            ['date', '=', $date],
                                            ['source', '=', $source],
                                            ['type', '=', 'sell'],
                                        ])->orderByDesc('created_at')->first();
                                        $buyChanged = !$lastBuy || $lastBuy->rate != $values['buy'];
                                        $sellChanged = !$lastSell || $lastSell->rate != $values['sell'];
                                        if ($buyChanged || $sellChanged) {
                                            BlueExchangeRate::create([
                                                'date' => $date,
                                                'source' => $source,
                                                'rate' => $values['buy'],
                                                'type' => 'buy',
                                            ]);
                                            BlueExchangeRate::create([
                                                'date' => $date,
                                                'source' => $source,
                                                'rate' => $values['sell'],
                                                'type' => 'sell',
                                            ]);
                                        } else {
                                            $this->info("{$source}: No hubo cambios en los valores blue (buy/sell)");
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                // Si es la API de Airtm
                if (str_contains($source, 'airtm.io')) {
                    if (isset($apiData['bob/usd']['addValue']) && isset($apiData['bob/usd']['withdrawValue'])) {
                        $buy = $apiData['bob/usd']['addValue'];
                        $sell = $apiData['bob/usd']['withdrawValue'];
                        $rate = round(($buy + $sell) / 2, 4);
                        $rates[] = $rate;
                        $lastBuy = BlueExchangeRate::where([
                            ['date', '=', $date],
                            ['source', '=', $source],
                            ['type', '=', 'buy'],
                        ])->orderByDesc('created_at')->first();
                        $lastBuy = BlueExchangeRate::where([
                            ['date', '=', $date],
                            ['source', '=', $source],
                            ['type', '=', 'buy'],
                        ])->orderByDesc('created_at')->first();
                        $lastSell = BlueExchangeRate::where([
                            ['date', '=', $date],
                            ['source', '=', $source],
                            ['type', '=', 'sell'],
                        ])->orderByDesc('created_at')->first();
                        $buyChanged = !$lastBuy || $lastBuy->rate != $buy;
                        $sellChanged = !$lastSell || $lastSell->rate != $sell;
                        if ($buyChanged || $sellChanged) {
                            BlueExchangeRate::create([
                                'date' => $date,
                                'source' => $source,
                                'rate' => $buy,
                                'type' => 'buy',
                            ]);
                            BlueExchangeRate::create([
                                'date' => $date,
                                'source' => $source,
                                'rate' => $sell,
                                'type' => 'sell',
                            ]);
                            $this->info("{$source}: buy={$buy} sell={$sell} promedio={$rate} BOB/USD");
                        } else {
                            $this->info("{$source}: No hubo cambios en los valores blue (buy/sell)");
                        }
                    }
                }
            } else {
                $this->warn("{$source}: No se encontró valor válido");
            }
        }

        if (count($rates) > 0) {
            $avg = round(array_sum($rates) / count($rates), 4);
            $this->info("Promedio blue: {$avg} BOB/USD");
        } else {
            $this->error('No se pudo calcular el promedio, todas las fuentes están en 0.');
        }
    }

    private function fetchApiData($url)
    {
        $response = Http::get($url);
        if ($response->ok()) {
            return $response->json();
        }
        return null;
    }
}
