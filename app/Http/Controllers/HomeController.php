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
            $weekDates = collect(range(0,6))->map(function($i){
                return now()->subDays(6-$i)->format('Y-m-d');
            });
            $weekRecords = BlueExchangeRate::whereIn('date', $weekDates)
                ->orderBy('date')
                ->get();
            $weekLabels = $weekDates->toArray();
            $weekBuyRates = $weekLabels;
            $weekSellRates = $weekLabels;
            foreach ($weekLabels as $i => $date) {
                $buy = $weekRecords->where('date', $date)->where('type', 'buy')->last();
                $sell = $weekRecords->where('date', $date)->where('type', 'sell')->last();
                $weekBuyRates[$i] = $buy ? $buy->rate : null;
                $weekSellRates[$i] = $sell ? $sell->rate : null;
            }

            // Mes
            $monthDates = collect(range(0,29))->map(function($i){
                return now()->subDays(29-$i)->format('Y-m-d');
            });
            $monthRecords = BlueExchangeRate::whereIn('date', $monthDates)
                ->orderBy('date')
                ->get();
            $monthLabels = $monthDates->toArray();
            $monthBuyRates = $monthLabels;
            $monthSellRates = $monthLabels;
            foreach ($monthLabels as $i => $date) {
                $buy = $monthRecords->where('date', $date)->where('type', 'buy')->last();
                $sell = $monthRecords->where('date', $date)->where('type', 'sell')->last();
                $monthBuyRates[$i] = $buy ? $buy->rate : null;
                $monthSellRates[$i] = $sell ? $sell->rate : null;
            }

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