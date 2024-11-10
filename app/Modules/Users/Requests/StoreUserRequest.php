<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'status' => 'required|in:active,inactive',
            'gender' => 'required|in:male,female',
            'password' => 'required|min:1|confirmed',
            'phone' => 'required',
        ];
    }
}
