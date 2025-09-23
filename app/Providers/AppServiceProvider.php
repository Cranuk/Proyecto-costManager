<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Directiva para fecha
        Blade::directive('formatDate', function ($date) {
            return "<?php echo \App\Helpers\Helpers::formatDate($date); ?>";
        });

        // Directiva para moneda
        Blade::directive('formatCurrency', function ($amount) {
            return "<?php echo \App\Helpers\Helpers::formatCurrency($amount); ?>";
        });

        // Directiva para balance total
        Blade::directive('balance', function () {
            return "<?php echo \App\Helpers\Helpers::getBalance()['balanceTotal']; ?>";
        });

        // Si querés usar balances por separado:
        Blade::directive('balancePositive', function () {
            return "<?php echo \App\Helpers\Helpers::getBalance()['balancePositive']; ?>";
        });

        Blade::directive('balanceNegative', function () {
            return "<?php echo \App\Helpers\Helpers::getBalance()['balanceNegative']; ?>";
        });
    }
}
