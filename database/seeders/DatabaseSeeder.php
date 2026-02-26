<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoomSeeder::class,
        ]);

        
        $this->call([
            BookingSeeder::class,
        ]);


        $this->call([
            ServiceSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
