<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

//Admin Routes

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get(
            '/bookings',
            [BookingController::class, 'admin_index']
        )->name('bookings.index');

        Route::post(
            '/bookings/check-availability',
            [BookingController::class, 'checkAvailability']
        )->name('bookings.availability');

        Route::get(
            '/bookings/show',
            [BookingController::class, 'showBookings']
        )->name('bookings.show');

        Route::get(
            '/bookings/available-rooms',
            [BookingController::class, 'showAvailableRooms']
        )->name('bookings.available');

        Route::post(
            '/bookings/create',
            [BookingController::class, 'storeBooking']
        )->name('bookings.create');

        Route::post(
            '/bookings/delete',
            [BookingController::class, 'deleteBooking']
        )->name('bookings.delete');
    });

//Client Routes

Route::prefix('client')->name('client.')->group(function () {

    // Client main page
    Route::get(
        '/bookings',
        [BookingController::class, 'client_index']
    )
        ->name('bookings.index');

    // Check room availability (client)
    Route::post(
        '/bookings/check-availability',
        [BookingController::class, 'checkAvailability']
    )
        ->name('bookings.availability');


    // My bookings client
    Route::get(
        '/bookings/my',
        [BookingController::class, 'myBookings']
    )
        ->name('bookings.my')->middleware('auth');

    // Show available rooms (client)
    Route::get(
        '/bookings/available-rooms',
        [BookingController::class, 'showAvailableRooms']
    )
        ->name('bookings.available');

    // Create new booking (client)
    Route::post(
        '/bookings/create',
        [BookingController::class, 'storeBooking']
    )
        ->name('bookings.create')->middleware('auth');

    // Delete booking (client)
    Route::post(
        '/bookings/delete',
        [BookingController::class, 'deleteBooking']
    )
        ->name('bookings.delete')->middleware('auth');
});
