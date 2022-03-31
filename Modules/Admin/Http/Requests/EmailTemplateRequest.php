<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EmailTemplateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
            'title'=> 'required',
            'from' => 'required|email',
            'subject' => 'required',
        ];
    }

    public function messages()
    {
        return [
           'from.email' => trans('message.email_valid_form'),
            'from.required' => trans('message.from_required'),
            'title.required'=> trans('message.title_filed_required'),
            'subject.required'=> trans('message.subject_reuired')
        ];
    }
}
