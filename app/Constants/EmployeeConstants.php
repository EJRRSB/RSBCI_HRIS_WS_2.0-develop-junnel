<?php

namespace App\Constants;

/**
 * Class EmployeeConstants
 * @package App\Constants
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.13
 */
class EmployeeConstants
{
    // Primary keys
    const EMPLOYEE_PRIMARY_KEY = 'id';
    const EMPLOYEE_CONTACTS_PRIMARY_KEY = 'id';
    const EMPLOYEE_BANK_INFO_PRIMARY_KEY = 'id';
    const EMPLOYEE_EDUCATIONS_PRIMARY_KEY = 'id';
    const EMPLOYEE_WORK_EXPERIENCE_PRIMARY_KEY = 'id';
    const EMPLOYEE_SKILL_PRIMARY_KEY = 'id';
    const EMPLOYEE_EMPLOYMENT_PRIMARY_KEY = 'id';
    const EMPLOYEE_BENEFITS_PRIMARY_KEY = 'id';
    const EMPLOYEE_POSITION_PRIMARY_KEY = 'id';
    const EMPLOYEE_SALARY_PRIMARY_KEY = 'id';
    const EMPLOYEE_EARNING_PRIMARY_KEY = 'id';
    const LOOKUP_PRIMARY_KEY = 'id';

    // Guarded fields
    const ID = 'id';
    const DELETED_at = 'deleted_at';
    const CREATED_at = 'created_at';
    const UPDATED_at = 'updated_at';

    // Table names
    const EMPLOYEE_TABLE_NAME = 'hr_employees';
    const EMPLOYEE_CONTACTS_TABLE_NAME = 'hr_employee_contacts';
    const EMPLOYEE_BANK_INFO_TABLE_NAME = 'hr_employee_bank_infos';
    const EMPLOYEE_EDUCATIONS_TABLE_NAME = 'hr_employee_educations';
    const EMPLOYEE_WORK_EXPERIENCE_TABLE_NAME = 'hr_employee_work_experiences';
    const EMPLOYEE_SKILL_TABLE_NAME = 'hr_employee_skills';
    const EMPLOYEE_EMPLOYMENT_TABLE_NAME = 'hr_employee_employments';
    const EMPLOYEE_BENEFITS_TABLE_NAME = 'hr_employee_benefits';
    const EMPLOYEE_POSITIONS_TABLE_NAME = 'hr_employee_positions';
    const EMPLOYEE_SALARY_TABLE_NAME = 'hr_employee_salaries';
    const EMPLOYEE_EARNING_TABLE_NAME = 'hr_employee_earnings';
    const LOOKUP_TABLE_NAME = 'hr_lookups';

    // Foreign keys
    const EMPLOYEE_ID = 'employee_id';
    const COMPANY_ID = 'company_id';
    const DEPARTMENT_ID = 'department_id';
    const DIVISION_ID = 'division_id';
    const LOCATION_ID = 'location_id';
    const TEAM_ID = 'team_id';
    const TENANT_ID = 'tenand_id';

    // Lookup fields
    const ATTRIBUTE_TYPE = 'attribute_type';
    const ATTRIBUTE_CODE = 'attribute_code';
    const ATTRIBUTE_VALUE = 'attribute_value';

    // Profile fields
    const STATUS = 'status';
    const REG_SOURCE = 'reg_source';
    const EMPLOYEE_NO = 'employee_no';
    const USERNAME = 'username';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMPLOYEE_CODE = 'employee_code';
    const BIOMETRIC_CODE = 'biometric_id';
    const MIDDLE_NAME = 'middle_name';
    const PREFERRED_NAME = 'preferred_name';
    const PROFILE_PHOTO = 'profile_photo';
    const WORK_EMAIL_ADDRESS = 'work_email_address';
    const PERSONAL_EMAIL_ADDRESS = 'personal_email_address';
    const MOBILE_NO = 'mobile_no';
    const COMPANY_MOBILE_NO = 'company_mobile_no';
    const WORK_PHONE_NO = 'work_phone_no';
    const GENDER = 'gender';
    const BIRTH_DATE = 'birth_date';
    const CIVIL_STATUS = 'civil_status';
    const CITIZENSHIP = 'citizenship';
    const RELIGION = 'religion';
    const HEIGHT = 'height';
    const WEIGHT = 'weight';
    const RESIDENCE_PHONE_NO = 'residence_phone_no';
    const TIN = 'tin';
    const TAX_TYPE = 'tax_type';
    const TAX_BRACKET = 'tax_bracket';
    const SSS_NO = 'sss_no';
    const PHIC_NO = 'phic_no';
    const HDMF_NO = 'hdmf_no';
    const CURRENCT_COUNTRY = 'current_country';
    const CURRENT_STREET_ADDRESS = 'current_street_address';
    const CURRENT_PROVINCE = 'current_province';
    const CURRENT_CITY = 'current_city';
    const CURRENT_ZIPCODE = 'current_zip_code';
    const PERMANENT_COUNTRY = 'permanent_country';
    const PERMANENT_STREET_ADDRESS = 'permanent_street_address';
    const PERMANENT_PROVINCE = 'permanent_province';
    const PERMANENT_CITY = 'permanent_city';
    const PERMANENT_ZIPCODE = 'permanent_zip_code';

    // Emergency and dependents fields
    const TYPE = 'contact_type';
    const IS_DEPENDENT = 'is_dependent';
    const FULL_NAME = 'full_name';
    const COUNTRY = 'country';
    const STREET_ADDRESS = 'street_address';
    const PROVINCE = 'province';
    const CITY = 'city';
    const ZIPCODE = 'zipcode';
    const RELATIONSHIP = 'relationship';

    //Employment fields
    const DATE_HIRED = 'date_hired';
    const EMPLOYMENT_STATUS = 'employment_status';
    const EMPLOYMENT_TYPE = 'employment_type';
    const REPORTING_TO = 'reporting_to';
    const REGULARIZATION_DATE = 'regularization_date';
    const SEPARATION_DATE = 'separation_date';
    const SEPARATION_REASON = 'separation_reason';

    // Benefits fields
    const HMO_COMPANY_NAME = 'hmo_company_name';
    const HMO_ID_NO = 'hmo_id_no';
    const BENEFITS_ELEGIBILITY_TYPE = 'benefits_elegibility_type';
    const MAXIMUM_BENEFIT_AMOUNT = 'maximum_benefit_amount';

    // Bank info fields
    const IS_DEFAULT = 'is_default';
    const PAYMENT_METHOD = 'payment_method';
    const BANK_NAME = 'bank_name';
    const BRANCH = 'branch';
    const BANK_ACCOUNT_TYPE = 'bank_account_type';
    const BANK_ACCOUNT_NAME = 'bank_account_name';
    const BANK_ACCOUNT_NO = 'bank_account_no';

    // Education fields
    const EDUCATIONAL_ATTAINMENT = 'educational_attainment';
    const INSTITUTION_NAME = 'institution_name';
    const START_MONTH = 'start_month';
    const START_YEAR = 'start_year';
    const END_MONTH = 'end_month';
    const END_YEAR = 'end_year';
    const DEGREE = 'degree';

    // Work experiences fields
    const JOB_TITLE = 'job_title';
    const JOB_LEVEL = 'job_level';
    const COMPANY_NAME = 'company_name';

    // Skill fields
    const SKILL = 'skill';
    const SKILL_LEVEL = 'skill_level';

    // Position fields
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const NOTES = 'notes';

    // Salary fields
    const BASIC_PAY = 'basic_pay';
    const RATE_TYPE = 'rate_type';
    const PAY_FREQUENCY = 'pay_frequency';

    // Earning fields
    const EARNING_TYPE = 'earning_type';
    const EARNING_CURRENCY = 'earning_currency';
    const EARNING_AMOUNT = 'earning_amount';
    const IS_TAXABLE = 'is_taxable';
    const EARNING_FREQUENCY = 'earning_frequency';
    const EARNING_NOTES = 'earning_notes';


    const EMPLOYEE_STATUS_CODE = [
        'activated'   => 1,
        'deactivated' => 2,
        'declined'    => 3,
        'pending'     => 4
    ];

    const EMPLOYEE_STATUSES = [
        1 => 'Active',
        2 => 'Deactivated',
        3 => 'Declined',
        4 => 'Pending'
    ];
}
