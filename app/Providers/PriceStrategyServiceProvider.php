<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Strategies\PriceStrategyFactory;
use App\Strategies\PriceStrategy;
use App\Strategies\StandardPriceStrategy;
use App\Strategies\SeasonalDiscountStrategy;

class PriceStrategyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PriceStrategyFactory::class, function ($app) {
            return new PriceStrategyFactory();
        });
    }
}