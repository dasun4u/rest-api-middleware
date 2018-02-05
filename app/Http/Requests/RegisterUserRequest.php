<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'string|max:50',
            'last_name' => 'string|max:50',
            'username' => 'required|string|max:50|unique:users',
            'mobile' => 'string|max:20',
            'email' => 'required|string|email|max:50',
            'avatar' => 'file|image|max:5120',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'first_name.string' => 'Invalid content',
            'first_name.max' => 'Character length must be less than 50',
            'last_name.string' => 'Invalid content',
            'last_name.max' => 'Character length must be less than 50',
            'username.required' => 'Username is Required',
            'username.string' => 'Invalid content',
            'username.max' => 'Character length must be less than 50',
            'username.unique' => 'Username is exist, Try another',
            'mobile.string' => 'Invalid content',
            'mobile.max' => 'Character length must be less than 20',
            'email.required' => 'Email is Required',
            'email.string' => 'Invalid content',
            'email.email' => 'Invalid email address',
            'email.max' => 'Character length must be less than 20',
            'avatar.file' => 'Profile must be a file',
            'avatar.image' => 'Profile must be a image',
            'avatar.max' => 'Profile image size must be less than 5MB',
            'password.required' => 'Password is Required',
            'password.string' => 'Invalid content',
            'password.min' => 'Character length must be more than 6',
            'password.confirmed' => 'Password confirmation is invalid',
        ];
    }
}
