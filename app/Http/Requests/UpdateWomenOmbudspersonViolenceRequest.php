<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWomenOmbudspersonViolenceRequest extends FormRequest
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
            'month_id'=>['required', Rule::unique('women_ombudsperson_violences', 'month_id')->where('department_id', $this->department_id)->where('district_id', $this->district_id)->where('year', $this->year)->ignore($this->women_ombudsperson_violence)],
            'year'=>'required',
            'complaints_proceeding_initiated'=>'required',
            'complaints_disposed_without_proceeding_initiated'=>'required',
            'total_cases_completed'=>'required',
            'total_cases_in_progress'=>'required',
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
            'complaints_proceeding_initiated.required'=> 'Complaints proceeding initiated is required.',
            'complaints_disposed_without_proceeding_initiated.required'=> 'Complaints disposed without initiating proceeding is required.',
            'total_cases_completed.required'=> 'Total case completed is required.',
            'total_cases_in_progress.required'=> 'Total cases in progress is required.',
        ];
    }
}
