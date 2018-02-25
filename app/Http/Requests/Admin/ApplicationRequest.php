<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ApplicationRequest extends FormRequest
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
                'name'=>'required|max:50',
                'description'=>'max:1000',
                'token_validity'=>'required|integer',
                'active'=>'in:on',
                'approved'=>'in:on',
                'production_key'=>'required|max:200|unique:applications,production_key',
                'production_secret'=>'required|max:200',
                'sandbox_key'=>'required|max:200|unique:applications,sandbox_key',
                'sandbox_secret'=>'required|max:200',
            ];
        } else if($method=='PUT') {
            return [
                'name'=>'required|max:50',
                'description'=>'max:1000',
                'token_validity'=>'required|integer',
                'active'=>'in:on',
                'approved'=>'in:on',
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
                'name.required'=>'Name is required',
                'name.max'=>'Name max character length is 50',
                'description.max'=>'Description max character length is 1000',
                'token_validity.required'=>'Token Validity is required',
                'token_validity.integer'=>'Token Validity must be an integer',
                'active.in'=>'Invalid state',
                'approved.in'=>'Invalid state',
                'production_key.required'=>'Production key is required',
                'production_key.max'=>'Production key max character length is 200',
                'production_key.unique'=>'Production key is exist',
                'production_secret.required'=>'Production secret is required',
                'production_secret.max'=>'Production secret max character length is 200',
                'sandbox_key.required'=>'Sandbox key is required',
                'sandbox_key.max'=>'Sandbox key max character length is 200',
                'sandbox_key.unique'=>'Sandbox key is exist',
                'sandbox_secret.required'=>'Sandbox secret is required',
                'sandbox_secret.max'=>'Sandbox secret max character length is 200',
            ];
        } else if($method=='PUT') {
            return [
                'name.required'=>'Name is required',
                'name.max'=>'Name max character length is 50',
                'description.max'=>'Description max character length is 1000',
                'token_validity.required'=>'Token Validity is required',
                'token_validity.integer'=>'Token Validity must be an integer',
                'active.in'=>'Invalid state',
                'approved.in'=>'Invalid state',
            ];
        } else {
            return [];
        }

    }
}
