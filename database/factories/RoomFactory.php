<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Room;

class RoomFactory extends Factory
{
    protected $model = Room::class;


    public function definition(): array
    {
        return [
            'name' => 'Room ' . $this->faker->word(),
            'description' => $this->faker->sentence(),
            'guests' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->randomFloat(2, 50, 300),
            'available' => $this->faker->boolean(80),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

