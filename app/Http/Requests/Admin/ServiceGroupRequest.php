<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ServiceGroupRequest extends FormRequest
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
                'context'=>'required|max:200|alpha_dash|unique:service_groups,context',
                'active'=>'in:on',
            ];
        } else if($method=='PUT') {
            return [
                'name'=>'required|max:100',
                'description'=>'max:1000',
                'context'=>'required|max:200|alpha_dash|unique:service_groups,context,'.$this->service_group->id,
                'active'=>'in:on',
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
                'active.in'=>'Invalid state',
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
                'active.in'=>'Invalid state',
            ];
        } else {
            return [];
        }
    }
}
