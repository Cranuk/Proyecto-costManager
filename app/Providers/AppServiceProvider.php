<?php

namespace App\Providers;

use Carbon\Carbon;
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
        Carbon::setLocale('es');
        
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

        // Directiva para nombre de categoria
        Blade::directive('nameCategory', function ($id) {
            return "<?php echo \App\Helpers\Helpers::nameCategory($id); ?>";
        });

        // Directiva para fecha en español
        Blade::directive('spanishDate', function ($date) {
            return "<?php echo \App\Helpers\Helpers::spanishDate($date); ?>";
        });

        // Directiva para tener informacion para el grafico
        Blade::directive('dataChart', function () {
            return "<?php echo \App\Helpers\Helpers::dataChart(); ?>";
        });
    }
}
