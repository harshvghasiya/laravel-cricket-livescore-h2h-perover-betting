<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'website_title' => 'required',
            'base_currency_symbol' => 'required',
            'base_currency_symbol_position' => 'required',
            'base_currency_text' => 'required',
            'base_currency_text_position' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'website_title.required' => trans('message.website_title_required'),
            'base_currency_symbol.required' => trans('message.base_currency_symbol_required'),
            'base_currency_text.required' => trans('message.base_currency_text_required'),
            'base_currency_text_position.required' => trans('message.base_currency_text_position_required'),
        ];
    }
}
