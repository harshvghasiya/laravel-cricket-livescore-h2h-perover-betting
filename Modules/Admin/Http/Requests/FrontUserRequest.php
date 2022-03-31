<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FrontUserRequest extends FormRequest
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
            // 'email' => 'required|email',
            'name' => 'required|checkNameExitFrontUser:' . $id . '',
             'mobile'=>'required',            
             'balance'=>'required',            

        ];

        if (isset($input['promo_code']) && $input['promo_code'] != null) {

            $data['promo_code'] = "checkFrontPromoCodeExist";
        }

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
            // 'email.required' => trans('message.email_required'),
            'name.required' => trans('message.name_required'),
            'balance.required' => trans('message.balance_required'),
            // 'email.email' => trans('message.email_valid_form'),
            'password.required' => trans('message.password_required'),
            'password.min' => trans('message.password_lenght_required'),
            'name.check_name_exit_front_user' => trans('message.name_exit_admin_user'),
            'promo_code.check_front_promo_code_exist' => trans('message.check_promo_code_exist'),

           
        ];
    }
}
