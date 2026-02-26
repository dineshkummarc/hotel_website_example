<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestCreateReview extends FormRequest
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
           'room_id'=>'required|exists:rooms,id',
           'rating'=>'required|integer|min:1|max:5',
           'comment'=>'nullable|string|max:1000',
        ];
    }
    public function messages():array 
    {
        return [
            'room_id'=>'Room Id required', 
            'rating.min'=>'Rating minimum 1',
            'rating.max'=>'Rating max 5',
            'rating.required'=>'Rating required'
        ];
    }
}