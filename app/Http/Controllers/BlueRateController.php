<?php

namespace App\Http\Controllers;

use App\Services\BlueRateUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class BlueRateController extends Controller
{
    public function manualUpdate(BlueRateUpdater $updater): JsonResponse
    {
        $ok = $updater->fetchAndStore(forceSnapshot: true);
        return response()->json(['success'=>$ok]);
    }

    public function snapshot(BlueRateUpdater $updater): JsonResponse
    {
        $ok = $updater->fetchAndStore(forceSnapshot: false);
        return response()->json(['success'=>$ok]);
    }

    // Diagnóstico: muestra claves reales dentro de data
    public function probe(): JsonResponse
    {
        $r = Http::timeout(12)->withOptions([
            'verify'=>filter_var(env('BLUE_HTTP_VERIFY', false), FILTER_VALIDATE_BOOLEAN)
        ])->get('https://rates.airtm.io/');
        $json = $r->ok() ? $r->json() : [];
        $payload = (isset($json['data']) && is_array($json['data'])) ? $json['data'] : $json;

        return response()->json([
            'airtm_status' => $r->status(),
            'has_bob_usd'  => isset($payload['bob/usd']),
            'bob_usd'      => $payload['bob/usd'] ?? null,
            'keys'         => array_slice(array_keys($payload ?? []), 0, 20)
        ]);
    }
}