<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CityRequest extends FormRequest
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
            'name' => 'required',
            'country_id' => 'required',
            'state_id'=>'required',
            'pin_code'=>'required|checkPinCodeExist:'.$id.'',
            

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'state_id.required' => trans('message.state_required'),
            'country_id.required' => trans('message.country_required'),
            'pin_code.required' => trans('message.pin_code_required'),
            'pin_code.check_pin_code_exist' => trans('message.check_pin_code_exist'),
           
        ];
    }
}
