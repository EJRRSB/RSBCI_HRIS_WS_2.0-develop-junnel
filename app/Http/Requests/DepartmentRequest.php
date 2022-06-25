<?php

namespace App\Http\Requests;

use App\Rules\DepartmentName;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'company_id' => ['required', 'exists:hr_companies,id,deleted_at,NULL'],
            'location_id' => ['nullable', 'exists:hr_locations,id,deleted_at,NULL'],
            'division_id' => ['nullable', 'exists:hr_divisions,id,deleted_at,NULL'],
            //'department_code' => ['required', 'max:6', 'unique:hr_departments,department_code,' .  $this->route('department')],
            'department_name' => ['required', 'max:80', new DepartmentName($this->input(), $this->route('department'))],
            'department_head' => ['nullable'], //Add the exists employee rule here once its become available
        ];
    }
}
