<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LocationRequest extends FormRequest
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
            'name' => 'required|checkLocationNameExist:'.$id.'',
            'contact_id' => 'required',
            'address_1' => 'required',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            

        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('message.name_required'),
            'name.check_location_name_exist' => trans('message.check_location_name_exist'),
            'contact_id.required' => trans('message.contact_is_required'),
            'address_1.required' => trans('message.address_1_required'),
            'city_id.required' => trans('message.city_is_required'),
            'state_id.required' => trans('message.state_is_required'),
            'country_id.required' => trans('message.country_is_required'),
           
        ];
    }
}
