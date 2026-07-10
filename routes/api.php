<?php

use App\Jobs\MonthlyBalanceJob;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::post('/crear-reporte', function () {
    $tokenDen8n = Request::header('X-Cron-Token');
    $tokenSecreto = config('app.cron_token_n8n');

    if (!$tokenDen8n || $tokenDen8n !== $tokenSecreto) {
        Log::channel('cron')->warning('Intento de acceso no autorizado al endpoint de reportes desde la IP: ' . Request::ip());
        return response()->json(['error' => 'No autorizado'], 401);
    }

    Log::channel('cron')->info('Endpoint /crear-reporte invocado exitosamente por n8n. Despachando Job...');

    try {
        dispatch_sync(new MonthlyBalanceJob());

        return response()->json([
            'status' => 'success',
            'message' => 'Procedimiento ejecutado y procesado con éxito.'
        ], 200);

    } catch (\Throwable $e) {
        Log::channel('cron')->error('Fallo crítico en el endpoint /crear-reporte al intentar despachar el Job', [
            'error' => $e->getMessage()
        ]);

        return response()->json([
            'status' => 'error',
            'message' => 'Hubo un error interno al procesar el balance.',
            'debug' => $e->getMessage() // Quitar en producción real, dejar solo en local
        ], 500);
    }
});
