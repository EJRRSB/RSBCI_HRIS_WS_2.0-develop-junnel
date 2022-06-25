<?php

namespace App\Services\Employee;

use App\Services\Employee\EmployeeBaseService;
use App\Repositories\Employee\ProfileRepository;
use App\Repositories\Onboarding\CompanyRepository;
use App\Repositories\Onboarding\TenantRepository;

use App\Models\Employee\Employee;
use App\Models\Company;
use App\Models\Tenant;

use App\Mail\Employee\RegistrationNotification;
use App\Mail\Employee\RegistrationHRNotification;

use App\Mail\Employee\ActivationStatusDeclined;
use Illuminate\Support\Facades\Mail;

use App\Constants\EmployeeConstants as constants;
use App\Constants\ResponseConstants as responses;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class ProfileService
 * @package App\Service
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.16
 */
class ProfileService extends EmployeeBaseService
{
    /**
     * Function to instantiantiate ProfileRepository
     * @param $repository
     */
    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
        $this->companyRepository = new CompanyRepository(new Company());
        $this->tenantRepository = new TenantRepository(new Tenant());
    }

    /**
     * Function to store employee profile information
     * @param $request
     * @return array
     */
    public function storeProfile($request)
    {
        $data = $request->all();

        if ($request->headers->has('reg_source') === true) {
            $data['status'] = constants::EMPLOYEE_STATUS_CODE['activated'];
        } else {
            $data['reg_source'] = 'Registration';
            $data['status'] = constants::EMPLOYEE_STATUS_CODE['pending'];
        }

        if (array_key_exists('profile_photo', $data) === true && empty($data['profile_photo']) === false) {
            $name = $this->uploadProfilePhoto($data['profile_photo']);
            $data['profile_photo'] = $name;
        }

        $result = $this->repository->storeProfile($data);

        if (is_array($result) === true) {
            $this->returnResponse[responses::STATUS_CODE] = responses::INTERNAL_SERVER_ERROR;
            $this->returnResponse[responses::RESULT]      = responses::FAIL;
            $this->returnResponse[responses::MESSAGE]     = 'Something went wrong while storing profile information.';
            return $this->returnResponse;
        }

        $sendEmailResult  = $this->sendNotificationEmail([
            'tenant_id'          => $data['tenant_id'],
            'first_name'         => $data['first_name'],
            'last_name'          => $data['last_name'],
            'work_email_address' => $data['work_email_address'],
            'reg_source'         => $data['reg_source'],
            'company_id'         => $data['company_id']
        ]);

        return $this->returnSuccessResponse();
    }

    /**
     * Function to upload profile photo
     * @param $file
     * @return string
     */
    private function uploadProfilePhoto($file)
    {
        $name = time() . '-' . $file->getClientOriginalName();
        $file->move('profile_photos', $name);

        return $name;
    }

    /**
     * Function to send notification email
     * @param $data
     */
    private function sendNotificationEmail($data)
    {
        $tenantInfo = $this->getTenantInformation($data);

        if ($data['reg_source'] === 'Registration') {
            Mail::to($data['work_email_address'])->send(new RegistrationNotification($data));

            $allData = array_merge($data, $tenantInfo);
            Mail::to($tenantInfo['tenant_work_email_address'])->send(new RegistrationHRNotification($allData));
        } else {
            $data['domain_name'] = $tenantInfo['tenant_domain_name'];
            $result = $this->setActivatedEmailData((object)$data);
            $this->repository->storeUser($result);
            $this->sendActivatedEmail($result);
        }
    }

    /**
     * Function to update employee information
     * @param $data
     * @param $id
     * @return array
     */
    public function updateEmployee($data, $id)
    {
        if (array_key_exists('profile_photo', $data) === true) {
            $data['profile_photo'] = $this->uploadProfilePhoto($data['profile_photo']);
        }

        $result = $this->repository->updateEmployee($id, $data);
        
        if ($result === false) {
            $this->returnResponse[responses::STATUS_CODE] = responses::INTERNAL_SERVER_ERROR;
            $this->returnResponse[responses::RESULT]      = responses::FAIL;
            $this->returnResponse[responses::MESSAGE]     = 'Something went wrong while storing employee information.';
            return $this->returnResponse;
        }

        return $this->returnSuccessResponse();
    }

    /**
     * Function to return success response
     * @return array
     */
    private function returnSuccessResponse()
    {
        $this->returnResponse[responses::STATUS_CODE] = responses::SUCCESS_REQUEST_CODE;
        $this->returnResponse[responses::RESULT]      = responses::SUCCESS;
        $this->returnResponse[responses::MESSAGE]     = responses::MESSAGE_OK;
        return $this->returnResponse;
    }
}
