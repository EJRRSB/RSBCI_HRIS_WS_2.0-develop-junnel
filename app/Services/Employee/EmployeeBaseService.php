<?php

namespace App\Services\Employee;

use App\Models\User;

use App\Mail\Employee\ActivationStatusActivated;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class EmployeeBaseService
 * @package App\Services\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.22
 */
class EmployeeBaseService
{
    protected $repository;

    protected $companyRepository;
    protected $tenantRepository;

    protected $returnResponse = ['result' => '','message' => ''];

    const EMPLOYEE_DEFAULT_ACCOUNT_TYPE = 3;

    /**
     * Function to get  domain name in url
     * @return string
     */
    protected function getDomainNameInUrl()
    {
        $url = explode('.', explode('//', url(''))[1]);
        return array_key_exists('www', array_flip($url)) === true ? $url[1] : $url[0];
    }

    /**
     * Function to set activated email data
     * @param $result
     * @return array
     */
    protected function setActivatedEmailData($result)
    {
        $temp_password = Str::random(10);

        return [
            'tenant_id'     => $result->tenant_id,
            'account_type'  => self::EMPLOYEE_DEFAULT_ACCOUNT_TYPE,
            'name'          => $result->first_name . ' ' . $result->last_name,
            'email'         => $result->work_email_address,
            'temp_password' => $temp_password,
            'password'      => Hash::make($temp_password),
            'domain_name'   => $result->domain_name
        ];
    }

    /**
     * Function to get tenant information
     * @param $data
     * @return array
     */
    protected function getTenantInformation($data)
    {
        $company = $this->companyRepository->getCompanyById($data['company_id']);
        $tenant = $this->tenantRepository->getTenantById($data['tenant_id']);

        return [
            'tenant_work_email_address' => $tenant->work_email,
            'tenant_first_name'         => $tenant->first_name,
            'tenant_last_name'          => $tenant->last_name,
            'tenant_domain_url'         => 'http://' . $tenant->domain_name . '.' . config('app.url') . '/employee-list',
            'company_name'              => $company->company_name,
            'tenant_domain_name'        => $tenant->domain_name
        ];
    }

    /**
     * Function to send email to employee with Activated status
     * @param $result
     */ 
    protected function sendActivatedEmail($result)
    {
        $result['url'] = 'http://' . $result['domain_name'] . '.'. config('app.url');
        $result['password'] = $result['temp_password'];

        Mail::to($result['email'])->send(new ActivationStatusActivated($result));
    } 
}
