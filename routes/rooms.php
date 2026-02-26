<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

//Show all rooms (Admin)
Route::get('/admin/rooms',
 [RoomController::class, 'showAllRoomsAdmin'])
 ->name('showAllRoomsAdmin')->middleware(['auth', 'admin']);
 
 //show all rooms (Client)
Route::get('/client/rooms',
 [RoomController::class, 'showAllRoomsClient'])
 ->name('showAllRoomsClient');


//Form create new Room
Route::get('/rooms/create', 
[RoomController::class, 'createRoomForm'])
->name('createRoomForm')->middleware(['auth', 'admin']);

//Create new room
Route::post('/rooms/create',
 [RoomController::class, 'createNewRoom'])
 ->name('createNewRoom')->middleware(['auth', 'admin']);

//form update room
Route::get('/rooms/{id}/edit', 
[RoomController::class, 'editRoom'])
->name('editRoom')->middleware(['auth', 'admin']);

//Update room
Route::put('/rooms/{id}', 
[RoomController::class, 'updateRoom'])
->name('updateRoom')->middleware(['auth', 'admin']);

//Delete room
Route::post('/rooms/delete',
 [RoomController::class, 'deleteRoom'])
 ->name('deleteRoom')->middleware(['auth', 'admin']);
