<?php

namespace App\Constants;

/**
 * Class ResponseConstants
 * @package App\Constants
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.7
 */
class ResponseConstants
{
    const STATUS_CODE = 'code';
    const RESULT = 'result';
    const DATA = 'data';
    const MESSAGE = 'message';

    const SUCCESS = 'Success';
    const FAIL = 'Failed';

    // protected $returnResponse = [];

    const SUCCESS_REQUEST_CODE = 200;
    const BAD_REQUEST_ERROR_CODE = 400;
    const NOT_FOUND_ERROR_CODE = 404;
    const INTERNAL_SERVER_ERROR = 500;

    const MESSAGE_OK = 'Ok.';
    const BAD_REQUEST_PARAMETERS = 'Invalid or missing parameters.';
    const NO_DATA = 'Data not found.';
    const EMPLOYEE_UPDATE_FAIL = 'Update employee details failed.';
    const EMPLOYEE_DELETE_FAIL = 'Delete employee details failed.';

    const EMPLOYEE_NOT_FOUND = 'Employee not found.';
    const CONTACT_INFO_NOT_FOUND = 'Contact information not found.';
    const EDUCATION_INFO_NOT_FOUND = 'Education information not found.';
    const WORK_EXPERIENCE_INFO_NOT_FOUND = 'Work experience information not found.';
    const SKILL_INFO_NOT_FOUND = 'Skill information not found.';
    const BANK_INFO_NOT_FOUND = 'Bank information not found.';
    const BENEFITS_INFO_NOT_FOUND = 'Benefits information not found.';
    const EMPLOYMENT_INFO_NOT_FOUND = 'Employment information not found.';
    const POSITION_INFO_NOT_FOUND = 'Employee position information not found.';
    const SALARY_INFO_NOT_FOUND = 'Employee salary information not found.';
    const EARNING_INFO_NOT_FOUND = 'Employee earning information not found.';

    const LOOKUP_NOT_FOUND = 'Lookup not found.';
    const LOOKUP_UPDATE_FAIL = 'Lookup update failed.';
    const LOOKUP_DELETE_FAIL = 'Lookup delete failed.';

    const CHECK_COMPANY_EXIST_ERROR = 'Checking company existence failed.';
    const CHECK_WORK_EMAIL_ADDRESS_EXIST_ERROR = 'Checking work email address existence failed.';
    const CHECK_USERNAME_EXIST_ERROR = 'Checking username existence failed.';
    const EMPLOYEE_LIST_ERROR = 'Something went wrong while fetching employee list.';
    const EMPLOYEE_UPDATE_STATUS_ERROR = 'Update employee status failed.';
}
