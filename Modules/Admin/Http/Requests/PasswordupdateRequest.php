<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PasswordupdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
       
        return [
            'current_password'=>'required|checkCurrentPassword',
            'password' => 'required|confirmed',
            

        ];
    }

    public function messages()
    {
        return [
            'password.required' => trans('message.password_required'),
            'password.confirmed' => trans('message.password_is_not_match'),
            'current_password.required' => trans('message.current_password_required'),
            'current_password.check_current_password' => trans('message.check_current_password'),
           
        ];
    }
}
