<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class ModuleRequest extends FormRequest
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
            'name' => 'required|checkModuleExist:'.$id.'',
            

        ];
    }

    public function messages()
    {

        return [
            'name.required' => trans('message.name_required'),
            'name.check_module_exist' => trans('message.check_module_exist_validation'),
           
        ];
    }
}
