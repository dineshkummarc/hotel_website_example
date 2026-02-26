<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//Form register new user
Route::get('/sign_in',
 [UserController::class, 'createUserForm'])
 ->name('signInLogin');

Route::post('/sign_in', 
[UserController::class, 'createUser'])
->name('signInUser');


 //Login form
 Route::post('/login', 
 [UserController::class, 'loginUser'])
 ->name('loginUser');

 Route::get('/logout', [UserController::class, 'logout'])
 ->name('logout');

 //Show all users   
 Route::get('/all_users',
[UserController::class,'showallUsers'])
->name('showAllUsers')->middleware(['auth', 'admin']);

//Delete User
Route::post('/delete_user/{id}',
 [UserController::class, 'deleteUser'])
 ->name('deleteUser')->middleware(['auth', 'admin']);

//Form Info user by Id
Route::get('/users/info', 
[UserController::class, 'infoUserForm'])
->name('infoUser');

//Info user by Id
Route::post('/users/info', 
[UserController::class, 'showUser'])
->name('showUser'); 

//Update User
Route::put('/update_user/{id}', [UserController::class, 'updateUser'])
->name('updateUser');