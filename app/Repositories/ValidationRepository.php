<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use App\Constants\APIConstants as constants;

//ELTON

use App\Models\Employee\Employee;
use App\Models\Tenant;
use App\Models\User;
/**
 * Class ValidationRepository
 * @package App\Repositories
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.10
 */
class ValidationRepository extends BaseRepository
{
    /**
     * Function to send api request to validate if company code exists
     * @param $companyCode
     * @return JsonResponse
     */
    public function validateCompanyCode($companyCode)
    {

        $endpoint = sprintf(constants::VALIDATION_ENDPOINTS['check_company_code'], $companyCode);
        $this->setHeader([]);
        return $this->get(config('app.API_URL'), $endpoint);
    }

    /**
     * Function to send api request to validate if employee work email address exists
     * @param $subDomain
     * @param $workEmailAddress
     * @return JsonResponse
     */
    public function validateWorkEmailAddress($subDomain, $workEmailAddress)
    {
        // $endpoint = sprintf(constants::VALIDATION_ENDPOINTS['check_work_email_address'], $subDomain, $workEmailAddress);
        // $this->setHeader([]);
        // return $this->get(config('app.API_URL'), $endpoint);

        $tenant = Tenant::where('domain_name', $subDomain)->first();
        $tenantId = is_null($tenant) === true ? null : $tenant->id;

        $result = Employee::where([
            'work_email_address' => $workEmailAddress,
            'tenant_id'          => $tenantId
        ])->first();


        return is_null($result) === false ? ['is_exist' => 1] : ['is_exist' => 0];
    }

    /**
     * Function to send api request to validate if employee username exists
     * @param $subDomain
     * @param $username
     * @return JsonResponse
     */
    public function validateUsername($subDomain, $username)
    {

        // $endpoint = sprintf(constants::VALIDATION_ENDPOINTS['check_username'], $subDomain, $username);
        // $this->setHeader([]);
        // return $this->get(config('app.API_URL'), $endpoint);

        $tenant = Tenant::where('domain_name', $subDomain)->first();
        $tenantId = is_null($tenant) === true ? null : $tenant->id;

        $result = Employee::where([
            'username'  => $username,
            'tenant_id' => $tenantId
        ])->first();

        return is_null($result) === false ? ['is_exist' => 1] : ['is_exist' => 0];
    }

    /**
     * Function to send api request to validate if tenant exists
     * @param $subDomain
     * @param $teant
     * @return JsonResponse
     */
    public function validateTenantName($subDomain)
    {  
        error_log("test 123");
        $tenant = Tenant::where('domain_name', $subDomain)->first();
        if ($tenant == null) {
            return response()->json(['is_exist' => 0]);
        } else {
            return response()->json(['is_exist' => 1]);
        }
    }

    
    public function validateEmail($email)
    {
        $tenant = Tenant::where('work_email', $email)->first();
        if ($tenant == null) {
            return response()->json(['is_exist' => 0]);
        } else {
            return response()->json(['is_exist' => 1]);
        }
    }

    
    public function validateCompanyName($company_name)
    {
        $tenant = Tenant::where('company_name', $company_name)->first();
        if ($tenant == null) {
            return response()->json(['is_exist' => 0]);
        } else {
            return response()->json(['is_exist' => 1]);
        }
    }
}
