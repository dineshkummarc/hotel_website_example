<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $services = [
            ['name' => 'Swimming Pool', 'description' => 'Access to the swimming pool', 'price' => 10.00],
            ['name' => 'Sauna', 'description' => 'Relax in the sauna', 'price' => 15.00],
            ['name' => 'Gym', 'description' => 'Use the gym facilities', 'price' => 20.00],
        ];

        return $this->faker->randomElement($services);
    }
}
