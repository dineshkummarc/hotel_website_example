<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use App\Http\Requests\FormRequestUser;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

   
    public function createUserForm()
    {
        return view('users.auth.sign_in'); 
    }

   
    public function createUser(FormRequestUser $request)
    {

        $this->userService->registerUser($request->validated());

        return redirect()->route('signInLogin')
            ->with('success', 'Registration successful. Please log in.');
    }

    
    public function loginUser(Request $request)
    {
        
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('showAllUsers');
            } else {
                return redirect()->route('infoUser'); 
            }
        }

        
        return back()->with('error', 'Invalid email or password');
    }
    
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/homepage')->with('success', 'Logout effettuato.');
}
    
    public function deleteUser($id)
    {
       $user = $this->userService->getUser($id);
    if (!$user) {
        return redirect()->route('showAllUsers')
            ->with('error', 'User not found.');
    }

    $this->authorize('delete', $user);

        $deleted = $this->userService->deleteUser($id);

        return redirect()->route('showAllUsers')
            ->with(
                $deleted ? 'success' : 'error',
                $deleted ? 'User deleted successfully.' : 'User not found.'
            );
    }

   
    public function editUser($id = null)
    {
        
        $user = $id ? $this->userService->getUser($id) : Auth::user();

        return view('users.update_user', compact('user'));
    }

    
    public function updateUser(FormRequestUser $request, $id = null)
    {
        $userToUpdate = $this->userService->getUser($id);

        $this->authorize('update', $userToUpdate);

        $id = $id ? $id : Auth::id(); 

        $validated=$request->validated();

        $this->userService->updateUser($id, $validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    
public function infoUserForm(UserService $userService)
{
    $user = Auth::user();
    
    $user = $userService->getUserInfoWithBookings($user->id);

    return view('users.client.user_info', [
        'user' => $user,
        'bookings' => $user->bookings,
    ]);
}

   
    public function showUser(Request $request)
    {
        $user = $this->userService->getUser($request->input('user_id'));

        return view('users.client.user_info', compact('user'));
    }

  
    public function showAllUsers()
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userService->getAllUsers();

        return view('users.admin.users', compact('users'));
    }
}
