<?php

namespace App\Services\Employee;

use App\Services\Employee\EmployeeBaseService;

use App\Repositories\Employee\EmployeeListRepository;
use App\Repositories\Onboarding\CompanyRepository;
use App\Repositories\Onboarding\TenantRepository;

use App\Models\Company;
use App\Models\Tenant;

use App\Mail\Employee\ActivationStatusDeclined;
use Illuminate\Support\Facades\Mail;

use App\Constants\ResponseConstants as responses;

/**
 * Class EmployeeListService
 * @package App\Service
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.7
 */
class EmployeeListService extends EmployeeBaseService
{
    /**
     * variable to store employee status codes
     */
    const EMPLOYEE_STATUS_CODE = [1,2,3,4];

    /**
     * Function to instantiate EmployeeListRepository
     */
    public function __construct(EmployeeListRepository $repository)
    {
        $this->repository = $repository;
        $this->companyRepository = new CompanyRepository(new Company());
        $this->tenantRepository = new TenantRepository(new Tenant());
    }

    /**
     * Function to check and fetch employee list
     * @param $tenantId
     * @return array
     */
    public function getAllEmployees($tenantId)
    {
        $result = $this->repository->getAllEmployees($tenantId);
        return $this->checkResult($result);
    }

    /**
     * Function to check and fetch employees by status
     * @param $tenantId
     * @param $status
     * @return array
     */
    public function getEmployeesByStatus($tenantId, $status)
    {
        $result = $this->repository->getEmployeesByStatus($tenantId, $status);
        return $this->checkResult($result);
    }

    /**
     * Function to check result of model
     * @param $result
     * @param $errorMessage
     * @return array
     */
    private function checkResult($result)
    {
        if (is_array($result) === true) {
            $this->returnResponse[responses::STATUS_CODE] = responses::INTERNAL_SERVER_ERROR;
            $this->returnResponse[responses::RESULT]      = responses::FAIL;
            $this->returnResponse[responses::MESSAGE]     = 'Something went wrong while fetching employee list.';
            return $this->returnResponse;
        }

        $this->returnResponse[responses::STATUS_CODE] = responses::SUCCESS_REQUEST_CODE;
        $this->returnResponse[responses::RESULT]      = responses::SUCCESS;
        $this->returnResponse[responses::DATA]        = $result;
        return $this->returnResponse;
    }

    /**
     * Function to check and update employee status
     * @param $id
     * @param $statusCode
     * @return array
     */
    public function updateStatus(int $id, int $statusCode)
    {
        if (in_array($statusCode, self::EMPLOYEE_STATUS_CODE) === false) {
            $this->returnResponse[responses::STATUS_CODE] = responses::BAD_REQUEST_ERROR_CODE;
            $this->returnResponse[responses::RESULT]      = responses::FAIL;
            $this->returnResponse[responses::MESSAGE]     = 'Invalid employee status code.';
            return $this->returnResponse;
        }

        $result = $this->repository->updateStatus($id, $statusCode);

        if (is_array($result) === true) {
            $this->returnResponse[responses::STATUS_CODE] = responses::INTERNAL_SERVER_ERROR;
            $this->returnResponse[responses::RESULT]      = responses::FAIL;
            $this->returnResponse[responses::MESSAGE]     = 'Something went wrong while updating employee status.';
            return $this->returnResponse;
        }

        if ($statusCode === 1) {
            $result['domain_name'] = $this->getDomainNameInUrl();
            $data = $this->setActivatedEmailData($result);
            $this->repository->storeUser($data);
            $this->sendActivatedEmail($data);
        } else {
            Mail::to($result->work_email_address)->send(new ActivationStatusDeclined());
        }
        
        $this->returnResponse[responses::STATUS_CODE] = responses::SUCCESS_REQUEST_CODE;
        $this->returnResponse[responses::RESULT]      = responses::SUCCESS;
        $this->returnResponse[responses::DATA]        = $result;

        return $this->returnResponse;
    }
}
