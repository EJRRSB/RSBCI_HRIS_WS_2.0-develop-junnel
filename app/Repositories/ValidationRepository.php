<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use App\Constants\APIConstants as constants;

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

        $endpoint = sprintf(constants::VALIDATION_ENDPOINTS['check_work_email_address'], $subDomain, $workEmailAddress);
        $this->setHeader([]);
        return $this->get(config('app.API_URL'), $endpoint);
    }

    /**
     * Function to send api request to validate if employee username exists
     * @param $subDomain
     * @param $username
     * @return JsonResponse
     */
    public function validateUsername($subDomain, $username)
    {

        $endpoint = sprintf(constants::VALIDATION_ENDPOINTS['check_username'], $subDomain, $username);
        $this->setHeader([]);
        return $this->get(config('app.API_URL'), $endpoint);
    }
}
