<?php

namespace App\Http\Controllers;

use App\Models\CurrencyExchangeRate;
use App\Models\BlueExchangeRate;

class HomeController extends Controller
{
    public function welcome()
    {
        // Usar blue_exchange_rates para la gráfica
    $last_update_obj = BlueExchangeRate::orderByDesc('created_at')->first();
    $last_update = $last_update_obj ? $last_update_obj->created_at : null;

    $bs_buy = BlueExchangeRate::where('type','buy')->orderByDesc('created_at')->first();
    $bs_sell = BlueExchangeRate::where('type','sell')->orderByDesc('created_at')->first();

        // Día actual (por hora si tienes datos horarios, aquí solo por día)
        $today = now()->format('Y-m-d');
        $dayRates = BlueExchangeRate::where('date', $today)->orderBy('date')->pluck('rate')->toArray();
        $dayLabels = BlueExchangeRate::where('date', $today)->orderBy('date')->pluck('date')->toArray();

        // Últimos 7 días
        $weekStart = now()->subDays(6)->format('Y-m-d');
        $weekRates = BlueExchangeRate::where('date', '>=', $weekStart)->where('type','buy')->orderBy('date')->pluck('rate')->toArray();
        $weekLabels = BlueExchangeRate::where('date', '>=', $weekStart)->where('type','buy')->orderBy('date')->pluck('date')->toArray();

        // Últimos 30 días
        $monthStart = now()->subDays(29)->format('Y-m-d');
        $monthRates = BlueExchangeRate::where('date', '>=', $monthStart)->where('type','buy')->orderBy('date')->pluck('rate')->toArray();
        $monthLabels = BlueExchangeRate::where('date', '>=', $monthStart)->where('type','buy')->orderBy('date')->pluck('date')->toArray();

        return view('welcome', [
            'bs_buy' => $bs_buy,
            'bs_sell' => $bs_sell,
            'last_update' => $last_update,
            'dayLabels' => $dayLabels,
            'dayRates' => $dayRates,
            'weekLabels' => $weekLabels,
            'weekRates' => $weekRates,
            'monthLabels' => $monthLabels,
            'monthRates' => $monthRates,
        ]);
    }
}
