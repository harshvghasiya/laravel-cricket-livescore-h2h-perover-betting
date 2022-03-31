<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SupportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
            'name'=> 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
           'email.email' => trans('message.email_valid_form'),
            'email.required' => trans('message.from_required'),
            'name.required'=> trans('message.name_required'),
            'subject.required'=> trans('message.subject_reuired'),
            'description.required'=> trans('message.description_reuired')
        ];
    }
}
