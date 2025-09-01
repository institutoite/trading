<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            ['code' => 'BOB', 'name' => 'Boliviano'],
            ['code' => 'USD', 'name' => 'Dólar estadounidense'],
            ['code' => 'ARS', 'name' => 'Peso argentino'],
            ['code' => 'CLP', 'name' => 'Peso chileno'],
            ['code' => 'PEN', 'name' => 'Sol peruano'],
            ['code' => 'EUR', 'name' => 'Euro'],
            ['code' => 'BRL', 'name' => 'Real brasileño'],
            ['code' => 'PYG', 'name' => 'Guaraní paraguayo'],
            ['code' => 'COP', 'name' => 'Peso colombiano'],
            ['code' => 'MXN', 'name' => 'Peso mexicano'],
            ['code' => 'GBP', 'name' => 'Libra esterlina'],
            ['code' => 'JPY', 'name' => 'Yen japonés'],
            ['code' => 'CNY', 'name' => 'Yuan chino'],
            ['code' => 'CHF', 'name' => 'Franco suizo'],
            ['code' => 'CAD', 'name' => 'Dólar canadiense'],
            ['code' => 'AUD', 'name' => 'Dólar australiano'],
            ['code' => 'UYU', 'name' => 'Peso uruguayo'],
            ['code' => 'VEF', 'name' => 'Bolívar venezolano'],
            ['code' => 'DOP', 'name' => 'Peso dominicano'],
            ['code' => 'GTQ', 'name' => 'Quetzal guatemalteco'],
            ['code' => 'HNL', 'name' => 'Lempira hondureño'],
            ['code' => 'CRC', 'name' => 'Colón costarricense'],
            ['code' => 'NIO', 'name' => 'Córdoba nicaragüense'],
            ['code' => 'SVC', 'name' => 'Colón salvadoreño'],
            // Puedes agregar más monedas aquí
        ];
        foreach ($currencies as $currency) {
            Currency::firstOrCreate(['code' => $currency['code']], $currency);
        }
    }
}
