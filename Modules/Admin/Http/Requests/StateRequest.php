<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StateRequest extends FormRequest
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
            'code'=>'required|checkStateExist:'.$id.''
            

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'country_id.required' => trans('message.country_required'),
            'code.required' => trans('message.code_required'),
            'code.check_state_exist' => trans('message.check_state_exist'),
           
        ];
    }
}
