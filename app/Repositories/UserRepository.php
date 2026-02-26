<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class UserRepository
{
    public function createUser(array $data)
    {
        Cache::forget('cache_users');
        
        return User::create($data);
    }

    public function getAllUsers()
    {
        return Cache::remember('cache_users',300, function(){
        return User::all();
        });
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function updateUser($id, array $data)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        
        Cache::forget('cache_users');

        $user->update($data);
        return $user;
    }

    public function deleteUserById($id)
    {
        Cache::forget('cache_users');

        return User::destroy($id);
    }

     public function getUserWithBookings($userId)
    {
        return User::with('bookings')->find($userId);
    }
}
