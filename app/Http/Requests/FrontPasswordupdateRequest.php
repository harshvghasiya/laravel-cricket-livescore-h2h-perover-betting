<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FrontPasswordupdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
       
        return [
            'current_password'=>'required|checkFrontCurrentPassword',
            'password' => 'required|confirmed|min:8',
            

        ];
    }

    public function messages()
    {
        return [
            'password.required' => trans('message.password_required'),
            'password.confirmed' => trans('message.password_is_not_match'),
            'password.min' => trans('message.password_lenght_required'),
            'current_password.required' => trans('message.current_password_required'),
            'current_password.check_front_current_password' => trans('message.check_current_password'),
           
        ];
    }
}
