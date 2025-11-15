<?php

namespace App\Http\Controllers;

use App\Models\BlueExchangeRate;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function welcome()
    {
        $tz = 'America/La_Paz';
        $now = Carbon::now($tz);
        $today = $now->toDateString();

        // Últimos registros globales
        $latest_buy  = BlueExchangeRate::where('type','buy')->orderByDesc('created_at')->first();
        $latest_sell = BlueExchangeRate::where('type','sell')->orderByDesc('created_at')->first();
        $last_update = $latest_buy? $latest_buy->created_at : ($latest_sell? $latest_sell->created_at : null);

        // Día (hoy) para la gráfica
        [$dayLabels, $dayBuyRates, $daySellRates] = $this->buildDailySeries(
            Carbon::parse($today, $tz),
            Carbon::parse($today, $tz)
        );

        // Semana: últimos 7 días (incluye hoy)
        $fromWeek = $now->copy()->subDays(6)->startOfDay();
        [$weekLabels, $weekBuyRates, $weekSellRates] = $this->buildDailySeries(
            $fromWeek,
            $now->copy()->startOfDay()
        );

        // Mes: últimos 30 días (incluye hoy)
        $fromMonth = $now->copy()->subDays(29)->startOfDay();
        [$monthLabels, $monthBuyRates, $monthSellRates] = $this->buildDailySeries(
            $fromMonth,
            $now->copy()->startOfDay()
        );

        // Año: últimos 12 meses, agregados por mes (toma el último registro del mes)
        [$yearLabels, $yearBuyRates, $yearSellRates] = $this->buildMonthlySeries($now, 12);

        // Para la comparativa del bloque "Blue vs Oficial" (valores de hoy)
        $bs_buy  = BlueExchangeRate::where('date',$today)->where('type','buy')->orderByDesc('created_at')->first();
        $bs_sell = BlueExchangeRate::where('date',$today)->where('type','sell')->orderByDesc('created_at')->first();

        // Si no tienes oficial aún:
        $official_buy = null;
        $official_sell = null;

        return view('welcome', compact(
            'latest_buy','latest_sell','last_update',
            'bs_buy','bs_sell','official_buy','official_sell',
            'dayLabels','dayBuyRates','daySellRates',
            'weekLabels','weekBuyRates','weekSellRates',
            'monthLabels','monthBuyRates','monthSellRates',
            'yearLabels','yearBuyRates','yearSellRates'
        ));
    }

    // Serie diaria: una muestra por día (último valor del día por type)
    private function buildDailySeries(Carbon $from, Carbon $to): array
    {
        $fromDate = $from->copy()->startOfDay()->toDateString();
        $toDate   = $to->copy()->startOfDay()->toDateString();

        $rows = BlueExchangeRate::whereBetween('date', [$fromDate, $toDate])
            ->orderBy('date')->orderBy('created_at')
            ->get()
            ->groupBy('date');

        $cursor = Carbon::parse($fromDate, $from->getTimezone());
        $end    = Carbon::parse($toDate, $from->getTimezone());

        $labels = [];
        $buy = [];
        $sell = [];

        while ($cursor->lte($end)) {
            $d = $cursor->toDateString();
            $labels[] = $cursor->format('d/m');

            $dayGroup = $rows->get($d, collect());
            $lastBuy  = $dayGroup->where('type','buy')->sortBy('created_at')->last();
            $lastSell = $dayGroup->where('type','sell')->sortBy('created_at')->last();

            $buy[]  = $lastBuy? (float)$lastBuy->rate : null;
            $sell[] = $lastSell? (float)$lastSell->rate : null;

            $cursor->addDay();
        }

        return [$labels, array_values($buy), array_values($sell)];
    }

    // Serie mensual: últimos N meses (toma el último registro de cada mes por type)
    private function buildMonthlySeries(Carbon $now, int $months = 12): array
    {
        $start = $now->copy()->startOfMonth()->subMonths($months - 1);
        $end   = $now->copy()->endOfMonth();
        $startDate = $start->toDateString();
        $endDate   = $end->toDateString();

        $rows = BlueExchangeRate::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')->orderBy('created_at')
            ->get()
            ->groupBy(function($r) {
                // YYYY-MM
                return substr($r->date, 0, 7);
            });

        $labels = [];
        $buy = [];
        $sell = [];

        $cursor = $start->copy();
        for ($i = 0; $i < $months; $i++) {
            $ym = $cursor->format('Y-m');
            $labels[] = $cursor->format('m/Y');

            $monthGroup = $rows->get($ym, collect());
            $lastBuy  = $monthGroup->where('type','buy')->sortBy('created_at')->last();
            $lastSell = $monthGroup->where('type','sell')->sortBy('created_at')->last();

            $buy[]  = $lastBuy? (float)$lastBuy->rate : null;
            $sell[] = $lastSell? (float)$lastSell->rate : null;

            $cursor->addMonth()->startOfMonth();
        }

        return [$labels, array_values($buy), array_values($sell)];
    }
}