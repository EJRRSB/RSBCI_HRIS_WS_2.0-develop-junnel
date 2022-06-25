<?php

namespace App\Constants;

/**
 * Class APIConstants
 * @package App\Constants
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.7
 */
class APIConstants
{
    const SUB_DOMAIN_NAME_KEY = 'SubDomainName';
    
    const EMPLOYEE_STATUSES = [
        1 => 'Active',
        2 => 'Deactivated',
        3 => 'Declined',
        4 => 'Pending'
    ];

    const EMPLOYEE_PROFILE_API_ENDPOINTS = [
        'main'          => '/api/v1/employee/profiles/detailed',
        'employee_list' => '/api/v1/employee/profiles/employee-list/%s',
        'update_status' => '/api/v1/employee/profiles/update-status/%s/%s',
    ];

    const EMPLOYEE_CONTACTS_API_ENDPOINTS = [
        'main'                    => '/api/v1/employee/contacts',
        'update_delete_dependent' => '/api/v1/employee/contacts/%s'
    ];

    const VALIDATION_ENDPOINTS = [
        'check_company_code'       => '/api/v1/validate/company_code/%s',
        'check_work_email_address' => '/api/v1/validate/work_email_address/%s/%s',
        'check_username'           => '/api/v1/validate/username/%s/%s'
    ];
}
