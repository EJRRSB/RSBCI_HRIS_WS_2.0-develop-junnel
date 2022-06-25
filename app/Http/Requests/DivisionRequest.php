<?php

namespace App\Http\Requests;

use App\Rules\DivisionName;
use Illuminate\Foundation\Http\FormRequest;

class DivisionRequest extends FormRequest
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
            //'division_code' => ['required', 'max:6'],
            'division_name' => ['required', 'max:80', new DivisionName($this->input())],
            'division_head' => ['nullable'], //Add the exists employee rule here once its become available
        ];
    }
}
