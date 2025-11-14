<?php

namespace App\Http\Controllers;

use App\Services\BlueRateUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BlueRateController extends Controller
{
    public function manualUpdate(BlueRateUpdater $updater): JsonResponse
    {
        try {
            $ok = $updater->fetchAndStore(forceSnapshot: true);
            return response()->json(['success' => $ok, 'message' => $ok ? 'Actualizado' : 'Sin cambios o sin datos']);
        } catch (\Throwable $e) {
            Log::error('manualUpdate error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Error interno'], 500);
        }
    }

    public function snapshot(BlueRateUpdater $updater): JsonResponse
    {
        try {
            $ok = $updater->fetchAndStore(forceSnapshot: false);
            return response()->json(['success' => $ok, 'message' => $ok ? 'Snapshot' : 'No era necesario']);
        } catch (\Throwable $e) {
            Log::error('snapshot error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Error interno'], 500);
        }
    }
}