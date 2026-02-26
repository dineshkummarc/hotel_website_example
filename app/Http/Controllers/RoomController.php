<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RoomService;
use App\Models\Room;
use App\Http\Requests\FormRequestRoom;

class RoomController extends Controller
{
    protected $roomService;
     
    public function __construct(RoomService $roomService) {
        $this->roomService= $roomService;
     }
    
   
     public function createRoomForm()
    {
    return view('rooms.create_room_form');
    }

 
   public function createNewRoom(FormRequestRoom $request)
{
    $this->authorize('create', Room::class);
    
    $validated = $request->validated();
    
    $images = $request->file('images');
    if ($images) {
        $validated['images'] = $images;
    }

    $this->roomService->createNewRoom($validated);

    return redirect()->back()->with('success', 'New Room Created');
}


    
    public function showAllRoomsAdmin($roomId = null)
{
    $rooms = $this->roomService->showAllRooms();

    $roomToEdit = null;

    if ($roomId) {
        $roomToEdit = $this->roomService->getRoomById($roomId);

        $this->authorize('update', $roomToEdit);
    }
 
    return view('rooms.admin.rooms', [
        'rooms' => $rooms,
        'roomToEdit' => $roomToEdit
    ]);
}


  public function showAllRoomsClient()
{
    $rooms = $this->roomService->showAllRooms();

    return view('rooms.client.rooms', ['rooms' => $rooms]);
}


  public function deleteRoom(Request $request)
    {
        $room = $this->roomService->getRoomById($request->id);

        if (!$room) {
            return redirect()->back()->with('fail', 'Room not found');
        }

        $this->authorize('delete', $room);

        $this->roomService->deleteRoom($room->id);

        return redirect()->back()->with('success', 'Room deleted');
    }

public function editRoom($id)
{
    return $this->showAllRoomsAdmin($id);
}

public function updateRoom(FormRequestRoom $request, $id)
{
     $room = $this->roomService->getRoomById($id);
        $this->authorize('update', $room);
        
    $validated = $request->validated();

    $this->roomService->updateRoom($id, $validated);

    return redirect()->back()->with('success', 'Room updated.');
}


}