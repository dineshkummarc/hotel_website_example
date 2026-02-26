<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Stmt\TraitUseAdaptation;

class FormRequestRoom extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'guests' => 'required|integer|min:1|max:10',
        'price' => 'required|numeric|min:0',
        'available' => 'required|boolean',
        'images.*' => 'nullable|file|max:2048',
        ];
    }

    public function messages():array
    {
         return [
        'name.required' => 'The room name is required.',
        'name.string'   => 'The room name must be a string.',
        'name.max'      => 'The room name may not exceed 255 characters.',

        'description.string' => 'The description must be a string.',

        'guests.required' => 'The number of guests is required.',
        'guests.integer'  => 'The number of guests must be an integer.',
        'guests.min'      => 'The minimum number of guests is 1.',
        'guests.max'      => 'The maximum number of guests is 10.',

        'price.required' => 'The price is required.',
        'price.numeric'  => 'The price must be a number.',
        'price.min'      => 'The price cannot be negative.',

        'available.required' => 'The availability field is required.',
        'available.boolean'  => 'The availability field must be true or false.'
    ];
    }
}
