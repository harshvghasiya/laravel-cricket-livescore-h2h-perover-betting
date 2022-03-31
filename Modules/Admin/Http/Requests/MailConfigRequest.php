<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MailConfigRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $r)
    {
        $input=$r->all();
        if(!isset($input['_method'])){
              $data['to_mail']='required|email';
            
        }else{
         $data= [
            'from_mail'=> 'required|email',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'encryption' => 'required',
            'smtp_username' => 'required|email',
            'smtp_password' => 'required',
        ];
        }

        
        return $data;
    }

    public function messages()
    {
        return [
           'from_mail.email' => trans('message.email_valid_form'),
           'to_mail.email' => trans('message.to_email_valid_form'),
            'to_mail.required' => trans('message.to_mail_required'),
            'from_mail.required' => trans('message.from_required'),
            'smtp_host.required'=> trans('message.smtp_host_filed_required'),
            'smtp_port.required'=> trans('message.smtp_port_required'),
            'encryption.required'=> trans('message.encryption_required'),
            'smtp_username.required'=> trans('message.smtp_username_required'),
            'smtp_password.required'=> trans('message.smtp_password_required'),
            'smtp_username.email'=> trans('message.smtp_email_valid'),
        ];
    }
}
