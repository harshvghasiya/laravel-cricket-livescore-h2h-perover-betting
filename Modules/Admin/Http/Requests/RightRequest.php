<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class RightRequest extends FormRequest
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
            'name' => 'required|checkRightExist:'.$id.'',
            'module_id' => 'required',
            

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'module_id.required' => trans('message.module_id_required'),
            'name.check_right_exist' => trans('message.check_right_exist_validation'),
           
        ];
    }
}
