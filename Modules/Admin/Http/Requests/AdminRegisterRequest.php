<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AdminRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {
        $input = $r->all();
        $id    = !empty($input['id']) ? $input['id'] : "";

        $data= [
            'email' => 'required|email|checkEmailExitAdminUser:' . $id . '',
            'name' => 'required',
            'right_id' => 'required',
            'image'=>'nullable|mimes:jpg,jpeg,png'
            

        ];

         if (isset($id) && !empty($id)) {

            if (isset($input['change_password']) && $input['change_password'] == 1) {

                $data['password'] = "required|min:8";
            }

        } else {

            $data['password'] = "required|min:8";
        }

        return $data;
    }

    public function messages()
    {
        return [
            'email.required' => trans('message.email_required'),
            'name.required' => trans('message.name_required'),
            'email.email' => trans('message.email_valid_form'),
            'right_id.required'=> trans('message.please_select_right_label'),
            'password.required' => trans('message.password_required'),
            'password.min' => trans('message.password_lenght_required'),
            'image.mimes' => trans('message.image_invalid'),
            'email.check_email_exit_admin_user' => trans('message.email_exit_admin_user'),

           
        ];
    }
}
