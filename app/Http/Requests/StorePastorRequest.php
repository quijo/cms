<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
        'email' => 'nullable|email|unique:pastors,email,' . $this->pastor?->id,
        'phone' => 'nullable|string|max:20',
        'status' => 'required|in:licensed,ordained,deacon,local',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'church_id' => 'nullable|exists:churches,id',
        'role' => 'nullable|in:pas,edu,admin,other',
        'address' => 'nullable|string|max:255',
    ];

}
}