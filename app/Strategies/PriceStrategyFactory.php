<?php

namespace App\Strategies;

class PriceStrategyFactory
{
    public function make(array $options = []): PriceStrategy
    {
        if (!empty($options['season']) && $options['season'] === 'low') {
            return new SeasonalDiscountStrategy();
        }

        return new StandardPriceStrategy();
    }
}