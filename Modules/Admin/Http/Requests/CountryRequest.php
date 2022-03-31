<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CountryRequest extends FormRequest
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
            'code'=>'required|checkCountryExist:'.$id.''
            

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'code.required' => trans('message.code_required'),
            'code.check_country_exist' => trans('message.check_country_exist'),
           
        ];
    }
}
