<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficialExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\OfficialExchangeRate::create([
            'date' => now()->format('Y-m-d'),
            'currency' => 'usd',
            'buy' => 6.86,
            'sell' => 6.96,
        ]);
    }
}
