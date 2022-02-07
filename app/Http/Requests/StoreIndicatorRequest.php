<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIndicatorRequest extends FormRequest
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
            'target_id'=>'required',
            'indicator_title'=>['required','string', Rule::unique('indicators', 'indicator_title')->where('target_id', $this->target_id)],
        ];
    }

    public function messages()
    {
        return [
            'indicator_title.unique' => 'Indicator title already exist in this target.',
        ];
    }
}
