<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'project_type_id'=>'required',
            'project_title'=>['required','string', Rule::unique('projects', 'project_title')->ignore($this->project)->where('project_type_id', $this->project_type_id)->where('department_id', $this->department_id)],
            'project_start_date'=>'required|date',
            'project_end_date'=>'required|date',
            'project_is_all_punjab'=>'required',
            'project_description'=>'sometimes|nullable',
            "district_ids"    => "required_if:project_is_all_punjab,0|array|min:1",
            "district_ids.*"  => "required_if:project_is_all_punjab,0|min:1",
        ];
    }

    public function messages()
    {
        return [
            'project_title.unique' => 'Project title already exist in this project type.',
            'project_is_all_punjab.required' => 'Project Location is required.',
            'district_ids.required_if' => 'At least one location is required.',
        ];
    }
}
