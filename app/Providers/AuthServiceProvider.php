<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Strategies\StandardPriceStrategy;
use App\Strategies\SeasonalDiscountStrategy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Booking::class => \App\Policies\BookingPolicy::class,
        \App\Models\Room::class => \App\Policies\RoomPolicy::class,
        \App\Models\Review::class => \App\Policies\ReviewPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}