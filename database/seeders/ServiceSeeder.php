<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Swimming Pool', 'description' => 'Access to the swimming pool', 'price' => 10.00],
            ['name' => 'Sauna', 'description' => 'Relax in the sauna', 'price' => 15.00],
            ['name' => 'Gym', 'description' => 'Use the gym facilities', 'price' => 20.00],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['name' => $service['name']], $service);
        }
    }
}
