<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoluntaryNationalReportRequest extends FormRequest
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
            'target_id'=>'required',
            'project_id'=>'required',
            'project_type_id'=>'required',
            'start_date'=>'required|date',
            'achievements'=>'required|string',
            'challenges'=>'required|string',
            'action_taken'=>'required|string',
            'way_forward'=>'required|string',
            'partnership'=>'required|string',
            'end_date'=>'required|date',
            'attachment'=>'required|mimes:jpg,jpeg,png,pdf',
        ];
    }
}
