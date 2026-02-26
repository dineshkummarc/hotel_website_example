<?php

namespace App\Http\Services;

use App\Repositories\RoomRepository;
use App\Repositories\BookingRepository;
use App\Models\Room;
use App\Exceptions\RoomNotAvailableException;
use Carbon\Carbon;
use App\Exceptions\BookingException;
use App\Strategies\PriceStrategyFactory;

class BookingService
{
    protected $roomRepository;
    protected $bookingRepository;
    protected $priceStrategy;
    protected $priceStrategyFactory;

    public function __construct(RoomRepository $roomRepository, BookingRepository $bookingRepository, PriceStrategyFactory $priceStrategyFactory)
    {
    $this->roomRepository = $roomRepository;
    $this->bookingRepository = $bookingRepository;
    $this->priceStrategyFactory = $priceStrategyFactory;
    }

    // Check if a room is available for a date range
    public function isAvailable(Room $room, $checkIn, $checkOut): bool
    {
        return !$this->bookingRepository->existsOverlap($room->id, $checkIn, $checkOut);
    }

    // Show bookings in a date range
    public function showBookings($checkIn, $checkOut)
    {
        $bookings = $this->bookingRepository->getByDateRange($checkIn, $checkOut);
        if ($bookings->isEmpty()) {
            return 'No bookings for this period';
        }
        return $bookings;
    }

    public function calculateTotalPrice($room, $checkIn, $checkOut, $options = [])
{
    $days = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
    $basePrice = $room->price * $days;

    $priceStrategy = $this->priceStrategyFactory->make($options);

    return $priceStrategy->calculatePrice($basePrice, $options);
}

    // Get all available rooms in a date range
    public function getAvailableRooms($checkIn, $checkOut)
    {
        $rooms = $this->roomRepository->all();

        if ($rooms->isEmpty()) {
        throw new BookingException('No rooms registered in the system.');
    }

        return $rooms->filter(function ($room) use ($checkIn, $checkOut) {
            return $this->isAvailable($room, $checkIn, $checkOut);
        });

    }

    // Show all bookings by user id
    public function getBookingsByUserId($userId)
    {
        return $this->bookingRepository->getBookingsByUserId($userId);
    }

    // Create a new booking
    public function createBooking(array $data, $user)
    {
    $roomId = $data['room_id'];
    $checkIn = $data['check_in'];
    $checkOut = $data['check_out'];
    $guestCount = $data['guest_count'] ?? 1;
    $userIdFromRequest = $data['user_id'] ?? null;
    $room = $this->roomRepository->find($roomId);
   
    if ($user->role === 'admin') {
    if (!$userIdFromRequest) {
        throw new \Exception('Admin must provide a user ID');
    }
    $userId = $userIdFromRequest;
    } else {
    $userId = $user->id;
    }

    if (!$room) {
        throw new RoomNotAvailableException('Room not found');
    }

    if ($guestCount > $room->guests) {
        throw new RoomNotAvailableException('Too many guests for this room');
    }

    if (strtotime($checkOut) <= strtotime($checkIn)) {
        throw new RoomNotAvailableException('Invalid date range');
    }

    if ($this->bookingRepository->existsOverlap($roomId, $checkIn, $checkOut)) {
        throw new RoomNotAvailableException('Room not available');
    }
   
    $month = Carbon::parse($checkIn)->month;
    $season = ($month >= 11 || $month <= 3) ? 'low' : 'high';
    $options = ['season' => $season];


    $options = ['season' => $season];
$totalPrice = $this->calculateTotalPrice($room, $checkIn, $checkOut, $options);
    
    return $this->bookingRepository->createBooking(
    $roomId,
    $userId,
    $checkIn,
    $checkOut,
    $guestCount,
    $totalPrice
    );
    }


    // Delete a booking by ID
    public function deleteBooking($bookingId): bool
    {
        return $this->bookingRepository->deleteById($bookingId);
    }
}
