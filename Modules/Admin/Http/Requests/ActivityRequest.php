<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ActivityRequest extends FormRequest
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
            'activity_subject_id' => 'required',
            'location_id' => 'required',
            'name' => 'required|checkActivityNameExist:'.$id.'',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            

        ];
    }

    public function messages()
    {
        return [
            'activity_subject_id.required' => trans('message.activity_subject_id_required'),
            'location_id.required' => trans('message.location_id_required'),
            'name.required' => trans('message.name_required'),
            'name.check_activity_name_exist' => trans('message.check_activity_name_exist'),
            'start_datetime.required' => trans('message.start_datetime_required'),
            'end_datetime.required' => trans('message.end_datetime_required'),
           
        ];
    }
}
