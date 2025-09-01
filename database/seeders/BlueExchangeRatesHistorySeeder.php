<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlueExchangeRate;
use Carbon\Carbon;

class BlueExchangeRatesHistorySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $start = 16.30;
        $end = 12.45;
        $days = 30;
        // Historial del mes (30 días) con tendencia descendente
        for ($i = $days; $i >= 0; $i--) {
            $date_buy = $now->copy()->subDays($i)->setTime(10, 0, 0); // Compra a las 10:00
            $date_sell = $now->copy()->subDays($i)->setTime(11, 0, 0); // Venta a las 11:00
            // Calcular el valor con tendencia descendente
            $rate = $start - (($start - $end) / $days) * ($days - $i);
            $rate += rand(-10, 10) / 100.0; // Pequeña variación aleatoria
            BlueExchangeRate::where('date', $date_buy->format('Y-m-d H:i:s'))->where('source', 'Seeder')->delete();
            BlueExchangeRate::where('date', $date_sell->format('Y-m-d H:i:s'))->where('source', 'Seeder')->delete();
            BlueExchangeRate::create([
                'type' => 'buy',
                'rate' => round($rate, 2),
                'date' => $date_buy->format('Y-m-d H:i:s'),
                'source' => 'Seeder',
            ]);
            BlueExchangeRate::create([
                'type' => 'sell',
                'rate' => round($rate + 0.10, 2),
                'date' => $date_sell->format('Y-m-d H:i:s'),
                'source' => 'Seeder',
            ]);
        }
    }
}
