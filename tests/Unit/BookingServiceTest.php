<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\BookingService;
use App\Repositories\RoomRepository;
use App\Repositories\BookingRepository;
use App\Strategies\PriceStrategyFactory;
use App\Models\Room;
use Mockery;

class BookingServiceTest extends TestCase
{
    protected $roomRepository;
    protected $bookingRepository;
    protected $priceStrategyFactory;
    protected $bookingService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->roomRepository = Mockery::mock(RoomRepository::class);
        $this->bookingRepository = Mockery::mock(BookingRepository::class);
        $this->priceStrategyFactory = Mockery::mock(PriceStrategyFactory::class);

        $this->bookingService = new BookingService(
            $this->roomRepository,
            $this->bookingRepository,
            $this->priceStrategyFactory
        );
    }
    

    public function test_room_is_available_when_no_overlap()
{
    $room = new Room();
    $room->id = 1;

    $this->bookingRepository
        ->shouldReceive('existsOverlap')
        ->once()
        ->with(1, '2026-03-01', '2026-03-05')
        ->andReturn(false);

    $result = $this->bookingService->isAvailable(
        $room,
        '2026-03-01',
        '2026-03-05'
    );

    $this->assertTrue($result);
}


public function test_room_is_not_available_when_overlap_exists()
{
    $room = new Room();
    $room->id = 1;

    $this->bookingRepository
    ->shouldReceive('existsOverlap')
    ->once()
    ->with(1, '2026-03-01', '2026-03-05')
    ->andReturn(true);

    $result = $this->bookingService->isAvailable(
        $room,
        '2026-03-01',
        '2026-03-05'
    );

    $this->assertFalse($result);
}


public function test_calculate_total_price_applies_strategy()
{
    $room = new Room();
    $room->price = 100;

    $mockStrategy = Mockery::mock(\App\Strategies\PriceStrategy::class);
$mockStrategy->shouldReceive('calculatePrice')
    ->once()
    ->with(300, ['season' => 'high'])
    ->andReturn(300);

$this->priceStrategyFactory
    ->shouldReceive('make')
    ->once()
    ->with(['season' => 'high'])
    ->andReturn($mockStrategy);


    $result = $this->bookingService->calculateTotalPrice(
        $room,
        '2026-04-01',
        '2026-04-04',
        ['season' => 'high']
    );

    $this->assertEquals(300, $result);
}

public function test_create_booking_success_for_normal_user()
{
    $room = new Room();
    $room->id = 1;
    $room->price = 100;
    $room->guests = 2;

    $user = (object) ['id' => 5, 'role' => 'user'];

    $data = [
        'room_id' => 1,
        'check_in' => '2026-04-01',
        'check_out' => '2026-04-04',
        'guest_count' => 2,
    ];

    $this->roomRepository
        ->shouldReceive('find')
        ->with(1)
        ->andReturn($room);

    $this->bookingRepository
        ->shouldReceive('existsOverlap')
        ->with(1, '2026-04-01', '2026-04-04')
        ->andReturn(false);

    $this->priceStrategyFactory
        ->shouldReceive('make')
        ->andReturn(Mockery::mock(\App\Strategies\PriceStrategy::class, function ($mock) {
            $mock->shouldReceive('calculatePrice')->andReturn(300);
        }));

    $this->bookingRepository
        ->shouldReceive('createBooking')
        ->with(1, 5, '2026-04-01', '2026-04-04', 2, 300)
        ->andReturn('booking_created');

    $result = $this->bookingService->createBooking($data, $user);

    $this->assertEquals('booking_created', $result);
}

public function test_create_booking_throws_exception_if_room_not_found()
{
    $user = (object) ['id' => 5, 'role' => 'user'];

    $this->roomRepository
        ->shouldReceive('find')
        ->with(1)
        ->andReturn(null);

    $this->expectException(\App\Exceptions\RoomNotAvailableException::class);

    $this->bookingService->createBooking([
        'room_id' => 1,
        'check_in' => '2026-04-01',
        'check_out' => '2026-04-04',
    ], $user);
}

public function test_create_booking_throws_exception_if_too_many_guests()
{
    $room = new Room();
    $room->id = 1;
    $room->guests = 2;

    $user = (object) ['id' => 5, 'role' => 'user'];

    $this->roomRepository
        ->shouldReceive('find')
        ->with(1)
        ->andReturn($room);

    $data = [
        'room_id' => 1,
        'check_in' => '2026-04-01',
        'check_out' => '2026-04-04',
        'guest_count' => 5,
    ];

    $this->expectException(\App\Exceptions\RoomNotAvailableException::class);

    $this->bookingService->createBooking($data, $user);
}

public function test_create_booking_throws_exception_if_dates_invalid()
{
    $room = new Room();
    $room->id = 1;
    $room->guests = 2;

    $user = (object) ['id' => 5, 'role' => 'user'];

    $this->roomRepository
        ->shouldReceive('find')
        ->with(1)
        ->andReturn($room);

    $data = [
        'room_id' => 1,
        'check_in' => '2026-04-04',
        'check_out' => '2026-04-01',
        'guest_count' => 2,
    ];

    $this->expectException(\App\Exceptions\RoomNotAvailableException::class);

    $this->bookingService->createBooking($data, $user);
}

public function test_create_booking_throws_exception_if_overlap_exists()
{
    $room = new Room();
    $room->id = 1;
    $room->guests = 2;

    $user = (object) ['id' => 5, 'role' => 'user'];

    $this->roomRepository
        ->shouldReceive('find')
        ->with(1)
        ->andReturn($room);

    $this->bookingRepository
        ->shouldReceive('existsOverlap')
        ->with(1, '2026-04-01', '2026-04-04')
        ->andReturn(true);

    $data = [
        'room_id' => 1,
        'check_in' => '2026-04-01',
        'check_out' => '2026-04-04',
        'guest_count' => 2,
    ];

    $this->expectException(\App\Exceptions\RoomNotAvailableException::class);

    $this->bookingService->createBooking($data, $user);
}

public function test_create_booking_throws_exception_if_admin_without_user_id()
{
    $user = (object) ['id' => 1, 'role' => 'admin'];

    $data = [
        'room_id' => 1,
        'check_in' => '2026-04-01',
        'check_out' => '2026-04-04',
        'guest_count' => 1,
    ];

   
    $this->roomRepository
        ->shouldReceive('find')
        ->with(1)
        ->once()
        ->andReturnNull(); 
    $this->expectException(\Exception::class);
    $this->expectExceptionMessage('Admin must provide a user ID');

    $this->bookingService->createBooking($data, $user);
}
}
