<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpcomingMatchRequest extends FormRequest
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
            'team_name_1' => 'required',
            'team_name_2' => 'required',
            'start_date_time'=>'required'
            

        ];
    }

    public function messages()
    {
        return [
            'team_name_1.required' => trans('message.team_name_1_required'),
            'team_name_2.required' => trans('message.team_name_2_required'),
            'start_date_time.required' => trans('message.start_datetime_required'),
           
        ];
    }
}
