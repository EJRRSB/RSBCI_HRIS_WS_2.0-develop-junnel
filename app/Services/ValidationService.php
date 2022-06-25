<?php

namespace App\Services;

use App\Repositories\ValidationRepository;
use App\Constants\ResponseConstants as responses;

/**
 * Class ValidationService
 * @package App\Service
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.10
 */
class ValidationService
{
    protected $validationRepository;

    /**
     * Function to instantiate ValidationRepository
     */
    public function __construct()
    {
        $this->validationRepository = new ValidationRepository();
    }

    /**
     * Function to validate if company exists
     * @param $companyCode
     * @return json
     */
    public function validateCompanyCode($companyCode)
    {
        $result = $this->validationRepository->validateCompanyCode($companyCode);

        if ($result->successful() === false) {
            $this->returnResponse[responses::RESULT] = responses::FAIL;
            $this->returnResponse[responses::MESSAGE] = 'Something went wrong while validating company code.';
            return json_encode($this->returnResponse);
        }

        return $result->body();
    }

    /**
     * Function to validate if employee work email address exists
     * @param $subDomain
     * @param $workEmailAddress
     * @return json
     */
    public function validateWorkEmailAddress($subDomain, $workEmailAddress)
    {
        // $subDomain = 'asadk'; // this is temporary hard coded sub domain. Should be remove

        $result = $this->validationRepository->validateWorkEmailAddress($subDomain, $workEmailAddress);
 
        return $result;
        // if ($result->successful() === false) {
        //     $this->returnResponse[responses::RESULT] = responses::FAIL;
        //     $this->returnResponse[responses::MESSAGE] = 'Something went wrong while validating work email address.';
        //     return json_encode($this->returnResponse);
        // }

        // return $result->body();
    }

    /**
     * Function to validate if employee username exists
     * @param $subDomain
     * @param $username
     * @return json
     */
    public function validateUsername($subDomain, $username)
    {

        // $subDomain = 'asadk'; // this is temporary hard coded sub domain. Should be remove

        $result = $this->validationRepository->validateUsername($subDomain, $username);

        return $result;
        // if ($result->successful() === false) {
        //     $this->returnResponse[responses::RESULT] = responses::FAIL;
        //     $this->returnResponse[responses::MESSAGE] = 'Something went wrong while validating username.';
        //     return json_encode($this->returnResponse);
        // }

        // return $result->body();
    }

    public function validateTenantName($subDomain)
    {
        $result = $this->validationRepository->validateTenantName($subDomain);

        return $result;
    }

    public function validateEmail($email)
    {
        $result = $this->validationRepository->validateEmail($email);

        return $result;
    }

    public function validateCompanyName($company_name)
    {
        $result = $this->validationRepository->validateCompanyName($company_name);

        return $result;
    }
}
