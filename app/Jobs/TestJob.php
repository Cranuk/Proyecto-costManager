<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;

class TestJob
{
    public function handle(): void
    {
        Log::info('----Se realizo el guardado del balance del mes anterior------');
    }
}
