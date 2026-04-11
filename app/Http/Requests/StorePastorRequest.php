<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePastorRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:pastors,email',
            'contact_number' => 'nullable|string|max:20',

            'minister_type' => 'nullable|in:ordained,licensed,deacon,local_pastor,other',
            'status' => 'nullable|in:active,inactive,retired,on_leave',

            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'church_id' => 'nullable|exists:churches,id',
            'role' => 'nullable|in:pas,edu,admin,other',

        ];
    }
}
