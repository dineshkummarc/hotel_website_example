<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RoomImage;
use App\Models\Room;
use Illuminate\Support\Arr;

class RoomImageFactory extends Factory
{
    protected $model = RoomImage::class;

    public function definition()
    {
        
        $images = [
            'images/rooms/photo-1568495248636-6432b97bd949.avif',
            'images/rooms/photo-1611892440504-42a792e24d32.avif',
            'images/rooms/photo-1618773928121-c32242e63f39.avif',
            'images/rooms/photo-1631049307264-da0ec9d70304.avif',
            'images/rooms/premium_photo-1661964402307-02267d1423f5.avif'
        ];

        
        $room = Room::inRandomOrder()->first();

        return [
            'room_id' => $room->id,
            'path' => $this->faker->randomElement($images),
        ];
    }
}
