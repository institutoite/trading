<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchangeRate;
use App\Models\BlueExchangeRate;

class HomeController extends Controller
{
    // Obtener tipo de cambio oficial (ejemplo: USD/BOB del Banco Central)
        public function welcome()
        {
            // Usar blue_exchange_rates para la gráfica
            $last_update_obj = BlueExchangeRate::orderByDesc('created_at')->first();
            $last_update = $last_update_obj ? $last_update_obj->created_at : null;

            $bs_buy = BlueExchangeRate::where('type','buy')->orderByDesc('created_at')->first();
            $bs_sell = BlueExchangeRate::where('type','sell')->orderByDesc('created_at')->first();

            // Día actual (por hora si tienes datos horarios, aquí solo por día)
            $today = now()->format('Y-m-d');
            // Día actual: obtener todos los registros y separar por tipo
            $dayRecords = BlueExchangeRate::where('date', $today)
                ->orderBy('created_at')
                ->get();
            $dayLabels = $dayRecords->map(function($rec) {
                return \Carbon\Carbon::parse($rec->created_at)->format('H:i');
            })->toArray();
            $dayBuyRates = $dayRecords->where('type', 'buy')->pluck('rate')->toArray();
            $daySellRates = $dayRecords->where('type', 'sell')->pluck('rate')->toArray();

            // Semana
            $weekStart = now()->subDays(6)->format('Y-m-d');
            $weekRecords = BlueExchangeRate::where('date', '>=', $weekStart)
                ->orderBy('date')
                ->get();
            $weekLabels = $weekRecords->map(function($rec) {
                return $rec->date;
            })->unique()->values()->toArray();
            $weekBuyRates = $weekRecords->where('type', 'buy')->pluck('rate')->toArray();
            $weekSellRates = $weekRecords->where('type', 'sell')->pluck('rate')->toArray();

            // Mes
            $monthStart = now()->subDays(29)->format('Y-m-d');
            $monthRecords = BlueExchangeRate::where('date', '>=', $monthStart)
                ->orderBy('date')
                ->get();
            $monthLabels = $monthRecords->map(function($rec) {
                return $rec->date;
            })->unique()->values()->toArray();
            $monthBuyRates = $monthRecords->where('type', 'buy')->pluck('rate')->toArray();
            $monthSellRates = $monthRecords->where('type', 'sell')->pluck('rate')->toArray();

        // Consultar tipo de cambio oficial desde la base de datos
        $official = \App\Models\OfficialExchangeRate::orderByDesc('date')->first();
        $official_buy = $official ? (object)['rate' => $official->buy] : null;
        $official_sell = $official ? (object)['rate' => $official->sell] : null;

            return view('welcome', [
                'bs_buy' => $bs_buy,
                'bs_sell' => $bs_sell,
                'last_update' => $last_update,
                'dayLabels' => $dayLabels,
                'dayBuyRates' => $dayBuyRates,
                'daySellRates' => $daySellRates,
                'weekLabels' => $weekLabels,
                'weekBuyRates' => $weekBuyRates,
                'weekSellRates' => $weekSellRates,
                'monthLabels' => $monthLabels,
                'monthBuyRates' => $monthBuyRates,
                'monthSellRates' => $monthSellRates,
                'official_buy' => $official_buy,
                'official_sell' => $official_sell,
            ]);
        }
}