<?php 

namespace App\Strategies;

interface PriceStrategy
{
    public function calculatePrice(int $basePrice, array $options = []): float;
}
