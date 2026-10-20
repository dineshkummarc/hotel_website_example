<?php

namespace App\Http\Services;

use App\Repositories\RoomRepository;

class RoomService
{

    protected RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomrepository)
    {
        $this->roomRepository = $roomrepository;
    }


    public function createNewRoom(array $data)
    {
        $images = $data['images'] ?? null;


        if ($images) {
            unset($data['images']);
        }


        return $this->roomRepository->create($data, $images);
    }


    public function showAllRooms()
    {
        return $this->roomRepository->all();
    }

    public function getThreeImagesForHomepage()
    {
        return $this->roomRepository->getThreeImagesForHomepage();
    }


    public function getRoomById($id)
    {
        return $this->roomRepository->find($id);
    }


    public function deleteRoom($id)
    {
        return $this->roomRepository->delete($id);
    }


    public function updateRoom($id, array $data)
    {
        return $this->roomRepository->update($id, $data);
    }
}
