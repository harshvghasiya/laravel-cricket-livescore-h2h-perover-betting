<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\BasicSetting;


class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        $captcha=BasicSetting::select('is_recaptcha')->first();
        $data= [
            'email' => 'required|email',
            'password' => 'required',
        ];

        if ( isset($captcha->is_recaptcha) && $captcha->is_recaptcha==1) {
            $data['g-recaptcha-response']="required";
        }

        return $data;
    }

    public function messages()
    {
        return [
            'email.required' => trans('message.email_required'),
            'email.email' => trans('message.email_valid_form'),
            'password.required' => trans('message.password_required'),
            'g-recaptcha-response.required' => trans('message.g_recaptcha_response_required'),
            'g-recaptcha-response.captcha' => trans('message.g_recaptcha_response_captcha'),
           
        ];
    }
}
