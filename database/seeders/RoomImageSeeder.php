<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use Illuminate\Support\Arr;

class RoomImageSeeder extends Seeder
{
    public function run(): void
    {
        
        $images = [
            'images/rooms/photo-1568495248636-6432b97bd949.avif',
            'images/rooms/photo-1611892440504-42a792e24d32.avif',
            'images/rooms/photo-1618773928121-c32242e63f39.avif',
            'images/rooms/photo-1631049307264-da0ec9d70304.avif',
            'images/rooms/premium_photo-1661964402307-02267d1423f5.avif',
        ];

        $rooms = Room::all();


foreach ($rooms as $room) {

  
    $numberOfImages = rand(1, 3);

   
    for ($i = 0; $i < $numberOfImages; $i++) {

        
        $randomImagePath = Arr::random($images);

       
        $room->images()->create([
            'path' => $randomImagePath,
        ]);
    }
    }
}
}
