<?php

namespace App\Strategies;

class SeasonalDiscountStrategy implements PriceStrategy
{
    public function calculatePrice(int $basePrice, array $options = []): float
    {
        if (!empty($options['season']) && $options['season'] === 'low') {
            $basePrice *= 0.8; 
        }
        return $basePrice;
    }
}