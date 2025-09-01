<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurrencyExchangeRate;
use Carbon\Carbon;

class BlueExchangeRateHistorySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        // Historial del mes (30 días)
        for ($i = 30; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i);
            $rate = 7.00 + rand(-20, 20) / 100.0; // Simula variación entre 6.80 y 7.20
            CurrencyExchangeRate::create([
                'currency' => 'blue',
                'type' => 'buy',
                'rate' => round($rate, 2),
                'date' => $date->format('Y-m-d'),
            ]);
            CurrencyExchangeRate::create([
                'currency' => 'blue',
                'type' => 'sell',
                'rate' => round($rate + 0.10, 2),
                'date' => $date->format('Y-m-d'),
            ]);
        }
    }
}
