<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CompanyCategoryRequest extends FormRequest
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
            'name' => 'required|checkCategoryExist:'.$id.'',
            

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'name.check_category_exist' => trans('message.check_category_exist'),
           
        ];
    }
}
