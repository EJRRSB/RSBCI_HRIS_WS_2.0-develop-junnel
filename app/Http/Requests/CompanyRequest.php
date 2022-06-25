<?php

namespace App\Http\Requests;

use App\Rules\ValidateURL;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [
            'company_logo_url' => ['nullable', 'max:3000', 'mimes:jpg,png'],
            'company_name' => ['required', 'min:3', 'max:100', 'unique:hr_companies,company_name,' . $this->input('id') . ',id,tenant_id,' .  $this->input('tenant_id')],
            'doing_business_as' => ['nullable', 'min:3', 'max:100'],
            'industry' => ['nullable', 'min:2', 'max:100'],
            'company_website_url' => ['nullable', 'bail', 'regex:' . $regex, 'min:4', 'max:255'],
            'location_id' => ['nullable', 'exists:hr_locations,id,deleted_at,NULL'],
            'business_phone_number' => ['nullable', 'min:7', 'max:20'],
            'tin' => ['nullable', 'min:9', 'max:15'],
            'company_code' => [
                'nullable', 'unique:hr_companies,company_code,' . $this->input('id') . ',id,tenant_id,' .  $this->input('tenant_id')
            ],
        ];
    }
}
