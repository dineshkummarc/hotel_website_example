<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\BookingService;
use App\Repositories\RoomRepository;
use App\Repositories\BookingRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormRequestStoreBooking;
use App\Http\Requests\FormRequestAvailableRooms;


class BookingController extends Controller
{
    protected $bookingService;
    protected $roomRepository;
    protected $bookingRepository;

    public function __construct(
        BookingService $bookingService,
        RoomRepository $roomRepository,
        BookingRepository $bookingRepository
    ) {
        $this->middleware('auth');
        $this->bookingService = $bookingService;
        $this->roomRepository = $roomRepository;
        $this->bookingRepository = $bookingRepository;
    }

     

    //Show view admin or client

    private function bookingsIndexView(Request $request): string
    {
        return $request->routeIs('admin.*')
            ? 'bookings.admin.index'
            : 'bookings.client.index';
    }

    // Admin index
    public function admin_index()
    {
        $rooms = $this->roomRepository->all();

        $bookings = collect();

    return view('bookings.admin.index', compact('rooms', 'bookings'));

    }

    // Client index
    public function client_index()
    {
    $rooms = $this->roomRepository->all();
    $checkIn = '';
    $checkOut = '';
    return view('bookings.client.index', compact('rooms', 'checkIn', 'checkOut'));
    }


    // Show bookings in a period (ADMIN)
    public function showBookings(Request $request)
{
    $checkIn = $request->check_in;
    $checkOut = $request->check_out;

    $bookings = collect(); // default vuoto

    if ($checkIn && $checkOut) {
        $bookings = $this->bookingRepository->getByDateRange($checkIn, $checkOut);
    }

    $rooms = $this->roomRepository->all();

    return view(
        'bookings.admin.index',
        compact('rooms', 'bookings', 'checkIn', 'checkOut')
    );
}

    // Show bookings auth user
public function myBookings()
{

    $user = Auth::user();

    $userId=Auth::id();
 
    $bookings = $this->bookingRepository->getBookingsByUserId($userId);
    $rooms = $this->roomRepository->all(); 

        return view('bookings.client.my_bookings', compact('bookings', 'rooms', 'user'));
}


    // Show available rooms
    public function showAvailableRooms(FormRequestAvailableRooms $request)
    {
    $checkIn = $request->check_in ?? '';
    $checkOut = $request->check_out ?? '';

    $availableRooms = $this->bookingService->getAvailableRooms($checkIn, $checkOut);

    $roomsWithPrice = $availableRooms->map(function ($room) use ($checkIn, $checkOut) {

    $room->total_price = $this->bookingService
        ->calculateTotalPrice($room, $checkIn, $checkOut);

    return $room;
});

        return view(
    $this->bookingsIndexView($request),
    [
        'rooms' => $roomsWithPrice,
        'checkIn' => $checkIn,
        'checkOut' => $checkOut,
        'bookings' => collect() 
    ]
);
    }

    // Create a new booking
public function storeBooking(FormRequestStoreBooking $request)
{

    $user = Auth::user();

    $data = $request->validated();

    $this->bookingService->createBooking($data, $user);

    return redirect()->back()->with('success', 'Booking created successfully');
}

    // Delete a booking
    public function deleteBooking(Request $request)
    {
        $deleted = $this->bookingRepository->deleteById($request->booking_id);

        return back()->with(
            $deleted ? 'Booking deleted!' : 'Booking not found!'
        );
    }
}
