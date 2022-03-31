<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ActivitySubjectRequest extends FormRequest
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
            'title' => 'required|checkActivitySubjectTitleExist:'.$id.'',
            

        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('message.title_required'),
            'title.check_activity_subject_title_exist' => trans('message.check_activity_subject_title_exist'),
           
        ];
    }
}
