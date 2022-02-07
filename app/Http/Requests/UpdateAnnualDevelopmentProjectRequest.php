<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnualDevelopmentProjectRequest extends FormRequest
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
            'project_id'=>'required',
            'project_type_id'=>'required',
            'project_document_file'=>'required_without:old_project_document_file|mimes:jpg,jpeg,png,pdf',
            'total_approved_budget'=>'required',
            'project_start_date'=>'required',
            'project_end_date'=>'required',
            'total_expenditure'=>'required',
            'beneficiary_male'=>'sometimes|nullable',
            'beneficiary_female'=>'sometimes|nullable',
            'beneficiary_trans_gender'=>'sometimes|nullable',
            'minority'=>'sometimes|nullable',
            'disability'=>'sometimes|nullable',
            'beneficiary_total'=>'required',
            'project_budgets.*.fiscal_year' => 'required',
            'project_budgets.*.budget_allocation' => 'required',
            'project_budgets.*.budget_utilization' => 'required',
            'progress_reports.*.progress_report_file'=> 'required_without:progress_reports.*.old_progress_report_file|mimes:jpg,jpeg,png,pdf',
        ];
    }

    public function messages()
    {
        return [
            'project_budgets.*.fiscal_year.required'=> 'Fiscal year is required.',
            'project_budgets.*.budget_allocation.required'=> 'Budget allocation is required.',
            'project_budgets.*.budget_utilization.required'=> 'Budget utilization is required.',
            'progress_reports.*.progress_report_file.required_without'=> 'Progress report is required.',
            'progress_reports.*.progress_report_file.mimes'=> 'Progress report is formats are jpeg,jpg,png,pdf.',
        ];
    }

}
