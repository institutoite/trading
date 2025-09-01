<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExchangeRate;
use App\Models\Currency;

class ExchangeRateSeeder extends Seeder
{
    public function run(): void
    {
        $rates = [
            // Ejemplo de tasas para el día actual
            ['from' => 'BOB', 'to' => 'USD', 'rate' => 0.14],
            ['from' => 'USD', 'to' => 'BOB', 'rate' => 7.00],
            ['from' => 'BOB', 'to' => 'ARS', 'rate' => 3.50],
            ['from' => 'ARS', 'to' => 'USD', 'rate' => 0.001],
            ['from' => 'USD', 'to' => 'ARS', 'rate' => 950],
            ['from' => 'BOB', 'to' => 'CLP', 'rate' => 120],
            ['from' => 'CLP', 'to' => 'USD', 'rate' => 0.0011],
            ['from' => 'USD', 'to' => 'CLP', 'rate' => 900],
            ['from' => 'BOB', 'to' => 'PEN', 'rate' => 0.38],
            ['from' => 'PEN', 'to' => 'USD', 'rate' => 0.27],
            ['from' => 'USD', 'to' => 'PEN', 'rate' => 3.7],
            // Nuevas combinaciones
            ['from' => 'ARS', 'to' => 'CLP', 'rate' => 8.5],
            ['from' => 'CLP', 'to' => 'ARS', 'rate' => 0.12],
            ['from' => 'ARS', 'to' => 'PEN', 'rate' => 0.004],
            ['from' => 'PEN', 'to' => 'ARS', 'rate' => 250],
            ['from' => 'CLP', 'to' => 'PEN', 'rate' => 0.003],
            ['from' => 'PEN', 'to' => 'CLP', 'rate' => 330],
            ['from' => 'BOB', 'to' => 'EUR', 'rate' => 0.13],
            ['from' => 'EUR', 'to' => 'BOB', 'rate' => 7.7],
            ['from' => 'USD', 'to' => 'EUR', 'rate' => 0.92],
            ['from' => 'EUR', 'to' => 'USD', 'rate' => 1.09],
            ['from' => 'ARS', 'to' => 'EUR', 'rate' => 0.0009],
            ['from' => 'EUR', 'to' => 'ARS', 'rate' => 1100],
        ];
        $date = date('Y-m-d');
        foreach ($rates as $rate) {
            $from = Currency::where('code', $rate['from'])->first();
            $to = Currency::where('code', $rate['to'])->first();
            if ($from && $to) {
                ExchangeRate::updateOrCreate([
                    'from_currency_id' => $from->id,
                    'to_currency_id' => $to->id,
                    'date' => $date,
                ], [
                    'rate' => $rate['rate'],
                ]);
            }
        }
    }
}
