<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormRequestAvailableRooms extends FormRequest
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
            'check_in'=>'required|date',
            'check_out'=>'required|date|after:check_in',
        ];
    }

     public function messages(): array
    {
        return [
            'check_in.required'  => 'Check-in is required.',
            'check_out.required' => 'Check-out is required.',
            'check_out.after'    => 'Check-out must be after check-in.',
        ];
    }
    
}
