<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class TestJob implements ShouldQueue
{
    use Queueable;
    public function handle(): void
    {
        Log::info('----Test de job con cola de trabajo------');
    }
}
