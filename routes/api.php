<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::post('/crear-reporte', function () {
    
    // Usamos el token que tenemos en el .env para validar la petición
    $tokenDen8n = Request::header('X-Cron-Token');
    $tokenSecreto = env('TOKEN_SECRET', 'miTokenSecretoCostManager322366');

    if ($tokenDen8n !== $tokenSecreto) {
        return response()->json(['error' => 'No autorizado'], 401);
    }

    // NOTE: Ejecutamos nuestro job MonthlyBalanceJob (bootstrap/app.php)
    Artisan::call('schedule:run');
    
    return response()->json([
        'status' => 'success',
        'message' => 'Procedimiento ejecutado con éxito.',
        'output' => trim(Artisan::output())
    ], 200);
});
