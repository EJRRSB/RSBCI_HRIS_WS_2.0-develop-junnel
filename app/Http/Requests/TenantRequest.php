<?php

namespace App\Http\Requests;

use App\Models\Tenant;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function __construct()
    {
        error_log($this->route());
    }
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
            'first_name' => ['required', 'max:100'],
            'last_name' => ['required', 'max:100'],
            'work_email' => ['required', 'email', 'max:100'],
            //'work_email' => ['required', 'email', 'max:100', 'unique:landlord.hr_tenants,work_email,' .  $this->route('client')],
            'mobile_number' => ['required', 'max:100'],
            'company_name' => ['required', 'max:100', 'unique:landlord.hr_tenants,company_name,' .  $this->route('client')],
            //'company_name' => ['required', 'max:100'],
            'industry' => ['required', 'max:100'],
            'company_size' => ['required', 'max:100'],
            'country' => ['required', 'max:255'],
            'domain_name' => ['required', 'max:100', 'alpha_num', 'unique:landlord.hr_tenants,domain_name,' .  $this->route('client')],
            //'domain_name' => ['required', 'max:100'],
            'inquiry' => ['required', 'max:255'],
            'inquiry' => ['required', 'max:255'],
            'is_agree' => ['required', 'in:1'],
        ];
    }
    public function messages()
    {
        return [
            'is_agree.in' => "You must accept the terms and conditions.",

        ];
    }
}
