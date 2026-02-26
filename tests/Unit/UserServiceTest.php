<?php

namespace Tests\Unit;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Http\Services\UserService;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
  protected $userRepository;
  protected $userService;


    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = Mockery::mock(UserRepository::class);
       
        $this->userService = new UserService(
            $this->userRepository,
        );
    }

    public function test_get_all_users_calls_repository()
{
    $users = [(object)['id' => 1, 'name' => 'Test']];
    
    $this->userRepository
        ->shouldReceive('getAllUsers')
        ->once()
        ->andReturn($users);

    $result = $this->userService->getAllUsers();
    $this->assertEquals($users, $result);
}

public function test_get_user_calls_repository_with_id()
{
    $user = (object)['id' => 1, 'name' => 'Test'];
    
    $this->userRepository
        ->shouldReceive('getUserById')
        ->with(1)
        ->once()
        ->andReturn($user);

    $result = $this->userService->getUser(1);
    $this->assertEquals($user, $result);
}

public function test_update_user_calls_repository_with_data()
{
    $data = ['name' => 'Updated'];
    $updatedUser = (object) array_merge(['id' => 1], $data);

    $this->userRepository
        ->shouldReceive('updateUser')
        ->with(1, $data)
        ->once()
        ->andReturn($updatedUser);

    $result = $this->userService->updateUser(1, $data);
    $this->assertEquals($updatedUser, $result);
}

public function test_delete_user_calls_repository()
{
    $this->userRepository
        ->shouldReceive('deleteUserById')
        ->with(1)
        ->once()
        ->andReturn(true);

    $result = $this->userService->deleteUser(1);
    $this->assertTrue($result);
}

}
