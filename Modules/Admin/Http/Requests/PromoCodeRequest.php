<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PromoCodeRequest extends FormRequest
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
            'balance' => 'required',
            'name'=>'required|checkPromoCodeExist:'.$id.''
            

        ];
    }

    public function messages()
    {
        return [
            'balance.required' => trans('message.balance_required'),
            'name.required' => trans('message.name_required'),
            'name.check_promo_code_exist' => trans('message.check_promo_code_exist'),
           
        ];
    }
}
