<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTargetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'target_value'=>'required|string',
            'target_factor'=>'required|string',
            'order_no'=>'required|numeric|not_in:0|min:1',
//            'icon_name'=>'required|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'order_no.numeric' => 'Please enter the valid Order No.',
            'order_no.not_in' => 'Please enter the valid Order No.',
            'order_no.min' => 'Please enter the valid Order No.',
        ];
    }
}
