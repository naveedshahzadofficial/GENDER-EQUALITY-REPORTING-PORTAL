<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePoliceDepartmentViolenceRequest extends FormRequest
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
            'department_id'=>'required',
            'district_id'=>'required',
            'month_id'=>['required', Rule::unique('police_department_violences', 'month_id')->where('department_id', $this->department_id)->where('district_id', $this->district_id)->where('year', $this->year)],
            'year'=>'required',
            'child_abuse'=>'required',
            'child_abuse_murder'=>'required',
            'child_labour'=>'required',
            'child_marriage'=>'required',
            'women_murder'=>'required',
            'women_domestic_violence'=>'required',
            'women_rape'=>'required',
            'women_gang_rape'=>'required',
            'women_kidnapping'=>'required',
            'women_burning'=>'required',
            'women_honour_killing'=>'required',
            'women_vani'=>'required',
            'women_forced_bonded_labour'=>'required',
            'women_other'=>'sometimes|nullable',
            'total'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'department_id.required'=> 'Department is required.',
            'district_id.required'=> 'District is required.',
            'month_id.required'=> 'Month name is required.',
            'month_id.unique'=> 'Month name is already exist in this district.',
            'year.required'=> 'Year is required.',
            'child_abuse.required'=> 'Child abuse is required.',
            'child_abuse_murder.required'=> 'Child abuse murder is required.',
            'child_labour.required'=> 'Child Labour is required.',
            'child_marriage.required'=> 'Child Marriage is required.',
            'women_murder.required'=> 'Murder is required.',
            'women_domestic_violence.required'=> 'Domestic violence is required.',
            'women_rape.required'=> 'Rape is required.',
            'women_gang_rape.required'=> 'Gang rape is required.',
            'women_kidnapping.required'=> 'Kidnapping/ Abduction is required.',
            'women_burning.required'=> 'Burning is required.',
            'women_honour_killing.required'=> 'Honour killing is required.',
            'women_vani.required'=> 'Vani is required.',
            'women_forced_bonded_labour.required'=> 'Forced/ Bonded labour is required.',
            'women_other.required'=> 'Other violence against women is required.',
            'total.required'=> 'Total is required.',
        ];
    }
}
