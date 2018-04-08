<?php

namespace App\Http\Requests\Developer;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'title'=>'required|max:255',
            'to'=>'required|array',
            'message'=>'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.max' => 'Title max character length is 255',
            'to.required' => 'To is required',
            'to.array' => 'To must be one or more names',
            'message.required' => 'Message is required',
            'message.max' => 'Message max character length is 1000',
        ];
    }
}
