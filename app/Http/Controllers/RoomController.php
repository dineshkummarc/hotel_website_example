<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RoomService;
use App\Models\Room;
use App\Http\Requests\FormRequestRoom;

class RoomController extends Controller
{
    protected RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    // Form to create a room
    public function createRoomForm()
    {
        $this->authorize('create', Room::class);

        return view('rooms.create_room_form');
    }

    // Create a new room
    public function createNewRoom(FormRequestRoom $request)
    {
        $this->authorize('create', Room::class);

        $validated = $request->validated();

        $images = $request->file('images');

        if ($images) {
            $validated['images'] = $images;
        }

        $this->roomService->createNewRoom($validated);

        return redirect()
            ->back()
            ->with('success', 'New Room Created');
    }

    // Show all rooms in admin area, optionally editing one
    public function showAllRoomsAdmin($roomId = null)
    {
        $this->authorize('viewAny', Room::class);

        $rooms = $this->roomService->showAllRooms();
        $roomToEdit = null;

        if ($roomId !== null) {
            $roomToEdit = $this->roomService->getRoomById($roomId);

            if (!$roomToEdit) {
                abort(404);
            }

            $this->authorize('update', $roomToEdit);
        }

        return view('rooms.admin.rooms', [
            'rooms' => $rooms,
            'roomToEdit' => $roomToEdit,
        ]);
    }

    // Show rooms to clients
    public function showAllRoomsClient()
    {
        $rooms = $this->roomService->showAllRooms();

        return view('rooms.client.rooms', [
            'rooms' => $rooms,
        ]);
    }

    // Delete a room
    public function deleteRoom(Request $request)
    {
        $room = $this->roomService->getRoomById($request->id);

        if (!$room) {
            return redirect()
                ->back()
                ->with('fail', 'Room not found');
        }

        $this->authorize('delete', $room);

        $this->roomService->deleteRoom($room->id);

        return redirect()
            ->back()
            ->with('success', 'Room deleted');
    }

    // Form to edit a room
    public function editRoom($id)
    {
        return $this->showAllRoomsAdmin($id);
    }

    // Update a room
    public function updateRoom(FormRequestRoom $request, $id)
    {
        $room = $this->roomService->getRoomById($id);

        if (!$room) {
            abort(404);
        }

        $this->authorize('update', $room);

        $validated = $request->validated();

        $this->roomService->updateRoom($id, $validated);

        return redirect()
            ->back()
            ->with('success', 'Room updated.');
    }
}
