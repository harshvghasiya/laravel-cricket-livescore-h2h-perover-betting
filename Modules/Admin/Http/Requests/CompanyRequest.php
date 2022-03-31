<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'company_category_id'=>'required',
            'contact_id'=>'required',
            'location_id'=>'required',
            'activity_id'=>'required',
            'notes'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'notes.required' => trans('message.notes_required'),
            'company_category_id.required' => trans('message.company_category_required'),
            'contact_id.required' => trans('message.contact_required'),
            'location_id.required' => trans('message.location_required'),
            'activity_id.required' => trans('message.activity_required'),
           
        ];
    }
}
