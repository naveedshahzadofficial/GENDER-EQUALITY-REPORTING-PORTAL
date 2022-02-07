<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'mobile_no' => ['required'],
            'cnic_no' => ['required',Rule::unique('users','cnic_no')->ignore(auth()->id())],
            'email' => ['required',Rule::unique('users','email')->ignore(auth()->id())],
        ];
    }
}
