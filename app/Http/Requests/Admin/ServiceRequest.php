<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ServiceRequest extends FormRequest
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
                'name'=>'required|max:100',
                'description'=>'max:1000',
                'context'=>'required|max:200|alpha_dash|unique:services,context',
                'method'=>'required|max:20',
                'production_uri'=>'required|max:200|url',
                'sandbox_uri'=>'required|max:200|url',
                'service_group'=>'required|exists:service_groups,id',
                'active'=>'in:on',
                'approved'=>'in:on',
            ];
        } else if($method=='PUT') {
            return [
                'name'=>'required|max:100',
                'description'=>'max:1000',
                'context'=>'required|max:200|alpha_dash|unique:services,context,'.$this->service,
                'method'=>'required|max:20',
                'production_uri'=>'required|max:200|url',
                'sandbox_uri'=>'required|max:200|url',
                'service_group'=>'required|exists:service_groups,id',
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
                'name.max'=>'Name max character length is 100',
                'description.max'=>'Description max character length is 1000',
                'context.required'=>'Context is required',
                'context.max'=>'Context max character length is 200',
                'context.alpha_dash'=>'Context invalid.(allow only _ and -)',
                'context.unique'=>'Context already used. Try another',
                'method.required'=>'Method is required',
                'method.max'=>'Method max character length is 20',
                'production_uri.required'=>'Production URL is required',
                'production_uri.max'=>'Production URL max character length is 200',
                'production_uri.url'=>'Production URL is invalid',
                'sandbox_uri.required'=>'Sandbox URL is required',
                'sandbox_uri.max'=>'Sandbox URL max character length is 200',
                'sandbox_uri.url'=>'Sandbox URL is invalid',
                'service_group.required'=>'Service group is required',
                'service_group.exists'=>'Service group is invalid',
                'active.in'=>'Invalid state',
                'approved.in'=>'Invalid state',
            ];
        } else if($method=='PUT') {
            return [
                'name.required'=>'Name is required',
                'name.max'=>'Name max character length is 100',
                'description.max'=>'Description max character length is 1000',
                'context.required'=>'Context is required',
                'context.max'=>'Context max character length is 200',
                'context.alpha_dash'=>'Context invalid.(allow only _ and -)',
                'context.unique'=>'Context already used. Try another',
                'method.required'=>'Method is required',
                'method.max'=>'Method max character length is 20',
                'production_uri.required'=>'Production URL is required',
                'production_uri.max'=>'Production URL max character length is 200',
                'production_uri.url'=>'Production URL is invalid',
                'sandbox_uri.required'=>'Sandbox URL is required',
                'sandbox_uri.max'=>'Sandbox URL max character length is 200',
                'sandbox_uri.url'=>'Sandbox URL is invalid',
                'service_group.required'=>'Service group is required',
                'service_group.exists'=>'Service group is invalid',
                'active.in'=>'Invalid state',
                'approved.in'=>'Invalid state',
            ];
        } else {
            return [];
        }
    }
}
