<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Services\ValidationService;

/**
 * Class ValidationController
 * @package App\Http\Controllers
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.10
 */
class ValidationController extends Controller
{
    /**
     * Function to instantiate Request and ValidationService
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->service = new ValidationService();
    }

    /**
     * Function to validate if employee work email address exists
     * @return json
     */
    public function validateCompanyCode()
    {
        return $this->service->validateCompanyCode($this->request->company_code);
    }

    /**
     * Function to validate if employee work email address exists
     * @return json
     */
    public function validateWorkEmailAddress()
    {
        return $this->service->validateWorkEmailAddress($this->getSubDomainFromURL(), $this->request->work_email_address);
    }

    /**
     * Function to validate if employee username exists
     * @return json
     */
    public function validateUsername()
    {
        return $this->service->validateUsername($this->getSubDomainFromURL(), $this->request->username);
    }
}
