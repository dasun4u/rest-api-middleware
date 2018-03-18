<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UserRequest extends FormRequest
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
        $method = Request::method();
        if($method=='POST'){
            return [
                'first_name'=>'max:50',
                'last_name'=>'max:50',
                'username'=>'required|max:50',
                'active'=>'in:on',
                'password'=>'required|min:6|max:50|confirmed',
                'password_confirmation'=>'required',
                'email'=>'required|email|max:50',
                'mobile'=>'max:20',
            ];
        } else if($method=='PUT') {
            return [
                'first_name'=>'max:50',
                'last_name'=>'max:50',
                'username'=>'required|max:50',
                'active'=>'in:on',
                'email'=>'required|email|max:50',
                'mobile'=>'max:20',
            ];
        } else {
            return [];
        }
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $method = Request::method();
        if($method=='POST'){
            return [
                'first_name.max'=>'First Name max character length is 50',
                'last_name.max'=>'Last Name max character length is 50',
                'username.required'=>'Username is required',
                'username.max'=>'Username max character length is 50',
                'active.in'=>'Invalid state',
                'password.required'=>'Password is required',
                'password.min'=>'Password minimum character length is 6',
                'password.max'=>'Password max character length is 50',
                'password.confirmed'=>'Password confirmation is invalid',
                'password_confirmation.required'=>'Password Confirmation is required',
                'email.required'=>'Email is required',
                'email.email'=>'Email is invalid',
                'email.max'=>'Email max character length is 50',
                'mobile.max'=>'Mobile max character length is 20',
            ];
        } else if($method=='PUT') {
            return [
                'first_name.max'=>'First Name max character length is 50',
                'last_name.max'=>'Last Name max character length is 50',
                'username.required'=>'Username is required',
                'username.max'=>'Username max character length is 50',
                'active.in'=>'Invalid state',
                'email.required'=>'Email is required',
                'email.email'=>'Email is invalid',
                'email.max'=>'Email max character length is 50',
                'mobile.max'=>'Mobile max character length is 20',
            ];
        } else {
            return [];
        }
    }
}
