<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormRequestUser;
use App\Models\User;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // Registration form
    public function createUserForm()
    {
        return view('users.auth.sign_in');
    }

    // Register a new user
    public function createUser(FormRequestUser $request)
    {
        $this->userService->registerUser($request->validated());

        return redirect()
            ->route('signInLogin')
            ->with('success', 'Registration successful. Please log in.');
    }

    // Login
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('showAllUsers');
            }

            return redirect()->route('infoUser');
        }

        return back()->with('error', 'Invalid email or password');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/homepage')
            ->with('success', 'Logout effettuato.');
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = $this->userService->getUser($id);

        if (!$user) {
            return redirect()
                ->route('showAllUsers')
                ->with('error', 'User not found.');
        }

        $this->authorize('delete', $user);

        $deleted = $this->userService->deleteUser($id);

        return redirect()
            ->route('showAllUsers')
            ->with(
                $deleted ? 'success' : 'error',
                $deleted
                    ? 'User deleted successfully.'
                    : 'User could not be deleted.'
            );
    }

    // Edit user form
    public function editUser($id = null)
    {
        $user = $id !== null
            ? $this->userService->getUser($id)
            : Auth::user();

        if (!$user) {
            abort(404);
        }

        $this->authorize('update', $user);

        return view('users.update_user', compact('user'));
    }

    // Update a user
    public function updateUser(FormRequestUser $request, $id = null)
    {
        $userToUpdate = $id !== null
            ? $this->userService->getUser($id)
            : Auth::user();

        if (!$userToUpdate) {
            abort(404);
        }

        $this->authorize('update', $userToUpdate);

        $validated = $request->validated();

        // The service receives the ID of the authorized user.
        $this->userService->updateUser(
            $userToUpdate->id,
            $validated
        );

        return redirect()
            ->back()
            ->with('success', 'User updated successfully.');
    }

    // Show authenticated user's information and bookings
    public function infoUserForm()
    {
        $user = Auth::user();

        $user = $this->userService
            ->getUserInfoWithBookings($user->id);

        return view('users.client.user_info', [
            'user' => $user,
            'bookings' => $user->bookings,
        ]);
    }

    // Show a specific user's information
    public function showUser(Request $request)
    {
        $user = $this->userService
            ->getUser($request->input('user_id'));

        if (!$user) {
            abort(404);
        }

        $this->authorize('update', $user);

        return view('users.client.user_info', compact('user'));
    }

    // Show all users (ADMIN)
    public function showAllUsers()
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userService->getAllUsers();

        return view('users.admin.users', compact('users'));
    }
}
