<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'emp_id' => 'required|numeric|digits_between:4,5',
            'full_name' => 'required',
            'campaign_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'campaign_id.required' => 'You must select a campaign'
        ];
    }
}
