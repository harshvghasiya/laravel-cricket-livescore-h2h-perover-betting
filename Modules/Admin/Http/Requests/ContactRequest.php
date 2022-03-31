<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {
        $input = $r->all();
        $id    = !empty($input['id']) ? $input['id'] : "";
        return [
            'full_name' => 'required|checkFullNameExist:'.$id.'',
            'phone_number'=>'required',
            'email_address'=>'required|email',
            // 'is_main_contact'=>'checkMainContactExist:'.$id.''


        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => trans('message.name_required'),
            'full_name.check_full_name_exist' => trans('message.name_already_exist'),
            'phone_number.required' => trans('message.phone_number_required'),
            'email_address.required' => trans('message.email_required'),
            'email_address.email' => trans('message.email_valid_form'),
           
        ];
    }
}
