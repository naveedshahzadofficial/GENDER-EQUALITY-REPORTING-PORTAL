<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFederalAgencyViolenceRequest extends FormRequest
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
            'month_id'=>['required', Rule::unique('federal_agency_violences', 'month_id')->where('department_id', $this->department_id)->where('district_id', $this->district_id)->where('year', $this->year)->ignore($this->federal_agency_violence)],
            'year'=>'required',
            'total_complaints'=>'required',
            'complaints_converted_to_fir'=>'required',
            'complaints_disposed_without_fir'=>'required',
            'complaints_in_process'=>'required',
            'case_completed'=>'required',
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
            'total_complaints.required'=> 'Total complaints is required.',
            'complaints_converted_to_fir.required'=> 'Converted to FIR is required.',
            'complaints_disposed_without_fir.required'=> 'Complaints disposed without FIR is required.',
            'complaints_in_process.required'=> 'Complaints in process is required.',
            'case_completed.required'=> 'Case completed is required.',
        ];
    }
}
