<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class FormRequestUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
      
    if (Auth::user()?->role === 'admin') {
        return true;
    }

    
    $userId = $this->route('id') ?? Auth::id();
    return Auth::id() === $userId;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         $userId = $this->route('id') ?? null;

        return [
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'required|min:6|confirmed',
        ];

          if (Auth::user()?->role === 'admin') {
            $rules['role'] = 'required|in:admin,client';
        } else {
            $this->merge(['role' => 'client']);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required.',
            'email.required'    => 'Email is required.',
            'email.email'       => 'Email must be valid.',
            'email.unique'      => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 6 characters.',
            'password.confirmed'=> 'Password confirmation does not match.',
            'role.required'     => 'Role is required.',
        ];
    }

}
