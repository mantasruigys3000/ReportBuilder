<?php

namespace App\Providers;

use App\Charts\AgeOverTimeChart;
use App\Charts\QuoteTypeAgeCount;
use App\Charts\SmokerChart;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\TestChart::class,
            SmokerChart::class,
            QuoteTypeAgeCount::class,
            AgeOverTimeChart::class,

        ]);
    }
}
