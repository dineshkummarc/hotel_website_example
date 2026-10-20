<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Support\Facades\Cache;

class RoomRepository
{

    public function create(array $data, $images = null)
    {

        $room = Room::create($data);

        Cache::forget('cache_room');
        Cache::forget('room_home_images');

        if ($images) {
            foreach ($images as $file) {

                $path = $file->store('images/rooms', 'public');


                $room->images()->create([
                    'path' => $path
                ]);
            }
        }

        return $room;
    }



    public function all()
    {

        $key = 'cache_room';

        return Cache::remember($key, 600, function () {
            return Room::with('images')->get();
        });
    }

    public function getThreeImagesForHomepage()
    {
        return Cache::remember('room_home_images', 600, function () {
            return RoomImage::take(3)->get();
        });
    }


    public function find($id)
    {
        return Room::findOrFail($id);
    }


    public function delete($id)
    {
        Cache::forget('cache_room');
        Cache::forget('room_home_images');

        return Room::where('id', $id)->delete();
    }


    public function update($id, array $data)
    {
        $room = Room::find($id);
        if (!$room) return null;
        else
            $room->update($data);

        Cache::forget('cache_room');
        Cache::forget('room_home_images');

        return $room;
    }
}
