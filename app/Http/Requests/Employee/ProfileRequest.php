<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\EmployeeConstants as constant;
use App\Constants\CommonConstants as common;

/**
 * Class ProfileRequest
 * @package App\Http\Requests\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.11
 */

class ProfileRequest extends FormRequest
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
            constant::EMPLOYEE_NO              => [
                common::NULLABLE,
                'unique:hr_employees,employee_no,' . $this->input('id') . ',id,tenant_id,' . $this->input('tenant_id')
            ],
            constant::COMPANY_ID               => [common::REQUIRED, 'exists:hr_companies,id,deleted_at,NULL'],
            constant::USERNAME                 => [
                common::REQUIRED, common::MIN_4, common::MAX_254,
                'unique:hr_employees,username,' . $this->input('id') . ',id,tenant_id,' . $this->input('tenant_id')
            ],
            constant::FIRST_NAME               => [common::REQUIRED, common::MIN_1, common::MAX_50],
            constant::LAST_NAME                => [common::REQUIRED, common::MIN_1, common::MAX_50],
            constant::EMPLOYEE_CODE            => [common::NULLABLE],
            constant::BIOMETRIC_CODE           => [common::NULLABLE],
            constant::MIDDLE_NAME              => [common::NULLABLE, common::MIN_1, common::MAX_50],
            constant::PREFERRED_NAME           => [common::NULLABLE, common::MIN_1, common::MAX_50],
            constant::PROFILE_PHOTO            => [common::NULLABLE, 'mimes:jpg,png'],
            constant::WORK_EMAIL_ADDRESS       => [common::REQUIRED, common::MIN_7, common::MAX_254, 'email'],
            // constant::WORK_EMAIL_ADDRESS       => [
            //     common::REQUIRED, common::MIN_7, common::MAX_254, 'email',
            //     'unique:hr_employees,work_email_address,' . $this->input('id') . ',id,tenant_id,' . $this->input('tenant_id')
            // ],
            // constant::PERSONAL_EMAIL_ADDRESS   => [
            //     common::NULLABLE, common::MIN_7, common::MAX_254,
            //     'unique:hr_employees,personal_email_address,' . $this->input('id') . ',id,tenant_id,' . $this->input('tenant_id')
            // ],
            constant::MOBILE_NO                => [common::NULLABLE, common::MIN_7, common::MAX_20],
            constant::COMPANY_MOBILE_NO        => [common::NULLABLE, common::MIN_7, common::MAX_20],
            constant::WORK_PHONE_NO             => [common::NULLABLE, common::MIN_7, common::MAX_20],
            constant::GENDER                   => [common::NULLABLE],
            constant::BIRTH_DATE               => [common::NULLABLE],
            constant::CIVIL_STATUS             => [common::NULLABLE],
            constant::CITIZENSHIP              => [common::NULLABLE],
            constant::RELIGION                 => [common::NULLABLE],
            constant::HEIGHT                   => [common::NULLABLE],
            constant::WEIGHT                   => [common::NULLABLE],
            constant::RESIDENCE_PHONE_NO       => [common::NULLABLE, common::MIN_7, common::MAX_20],
            constant::TIN                      => [common::NULLABLE, common::MIN_1, common::MAX_20],
            constant::TAX_TYPE                 => [common::NULLABLE],
            constant::TAX_BRACKET              => [common::NULLABLE],
            constant::SSS_NO                   => [common::NULLABLE, common::MIN_1, common::MAX_20],
            constant::PHIC_NO                  => [common::NULLABLE, common::MIN_1, common::MAX_20],
            constant::HDMF_NO                  => [common::NULLABLE, common::MIN_1, common::MAX_20],
            constant::CURRENCT_COUNTRY         => [common::NULLABLE],
            constant::CURRENT_STREET_ADDRESS   => [common::NULLABLE, common::MIN_10, common::MAX_150],
            constant::CURRENT_PROVINCE         => [common::NULLABLE],
            constant::CURRENT_CITY             => [common::NULLABLE],
            constant::CURRENT_ZIPCODE          => [common::NULLABLE, common::MIN_2, common::MAX_15],
            constant::PERMANENT_COUNTRY        => [common::NULLABLE],
            constant::PERMANENT_STREET_ADDRESS => [common::NULLABLE, common::MIN_10, common::MAX_150],
            constant::PERMANENT_PROVINCE       => [common::NULLABLE],
            constant::PERMANENT_CITY           => [common::NULLABLE],
            constant::PERMANENT_ZIPCODE        => [common::NULLABLE, common::MIN_2, common::MAX_15]
        ];
    }
}
