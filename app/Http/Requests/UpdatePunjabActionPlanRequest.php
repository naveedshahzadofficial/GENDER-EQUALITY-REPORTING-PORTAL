<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePunjabActionPlanRequest extends FormRequest
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
            'year'=>'required',
            'target_id'=>'required',
            'indicator_id'=>'required',
            'indicator_framework_file'=>'required_without:old_indicator_framework_file|mimes:jpg,jpeg,png,pdf',
            'baseline'=>'required',
            'reporting_agency'=>'required',
            'implementation_responsibility'=>'required',
            'target_reforms.*.defining_action' => 'required',
            'target_reforms.*.defining_date' => 'required',
            'target_reforms.*.progress_status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'department_id.required'=> 'Department is required.',
            'year.required'=> 'Year is required.',
            'target_id.required'=> 'Target is required.',
            'indicator_id.required'=> 'Indicator is required.',
            'indicator_framework_file.required_without'=> 'Indicator framework file is required.',
            'indicator_framework_file.mimes'=> 'Indicator framework file is formats are jpeg,jpg,png,pdf.',
            'baseline.required'=> 'Baseline is required.',
            'reporting_agency.required'=> 'Reporting agency is required.',
            'implementation_responsibility.required'=> 'Implementation responsibility is required.',
            'target_reforms.*.defining_action.required'=> 'Defining action is required.',
            'target_reforms.*.defining_date.required'=> 'Reform action defining date is required.',
            'target_reforms.*.progress_status.required'=> 'Reform action plan progress status is required.',


        ];
    }
}
