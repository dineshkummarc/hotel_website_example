<?php

namespace App\Strategies;

class StandardPriceStrategy implements PriceStrategy
{
    public function calculatePrice(int $basePrice, array $options = []): float
    {
        return $basePrice;
    }
}