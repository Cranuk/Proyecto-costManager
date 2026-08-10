<?php

use App\Jobs\MonthlyBalanceJob;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::post('/crear-reporte', function () {
    $tokenDen8n = Request::header('X-Cron-Token');
    $tokenSecreto = config('app.cron_token_n8n');

    if (!$tokenDen8n || $tokenDen8n !== $tokenSecreto) {
        Log::channel('cron')->warning('Acceso no autorizado al endpoint desde la IP: ' . Request::ip());
        return response()->json(['error' => 'No autorizado'], 401);
    }

    Log::channel('cron')->info('Realizando reporte mensual');

    try {
        dispatch_sync(new MonthlyBalanceJob());

        Log::channel('cron')->info('Reporte mensual generado con éxito');

        return response()->json([
            'status' => 'success',
            'message' => 'Reporte mensual generado con éxito'
        ], 200);

    } catch (\Throwable $e) {
        Log::channel('cron')->error('Error al generar el reporte mensual ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Error al generar el reporte mensual',
            'debug' => $e->getMessage() // Quitar en producción real, dejar solo en local
        ], 500);
    }
});
