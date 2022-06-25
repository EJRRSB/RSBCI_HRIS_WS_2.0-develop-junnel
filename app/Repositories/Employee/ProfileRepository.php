<?php

namespace App\Repositories\Employee;

use App\Repositories\Employee\EmployeeBaseRepository;
use App\Repositories\Onboarding\CompanyRepository;
use App\Repositories\Onboarding\TenantRepository;

use App\Models\Employee\Employee;
use App\Models\Employee\BankInformation;
use App\Models\Employee\Benefit;
use App\Models\Employee\Contact;
use App\Models\Employee\Earning;
use App\Models\Employee\Education;
use App\Models\Employee\Employment;
use App\Models\Employee\Position;
use App\Models\Employee\Salary;
use App\Models\Employee\Skill;
use App\Models\Employee\WorkExperience;
use App\Models\Company;
use App\Models\Tenant;
use App\Models\User;

use Exception;
use Illuminate\Database\Eloquent\Collection;

use App\Constants\EmployeeConstants as constants;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class ProfileRepository
 * @package App\Repositories\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.11
 */
class ProfileRepository extends EmployeeBaseRepository
{
    const PAGINATION_PER_PAGE = 10;
    const EMPLOYEE_DEFAULT_ACCOUNT_TYPE = 3;

    /**
     * Function to instantiate Employee model
     */
    public function __construct(Employee $employeeModel)
    {
        $this->model = $employeeModel;
    }

    /**
     * Function to store employee in database
     * @param $data
     * @return Collection
     */
    public function storeProfile(array $data)
    {
        try{
            $result = $this->store($data);
            $this->updateEmployeeCodeAndNumber($result);

            return $result->id;
        } catch(Exception $error) {
            return [
                'code'    => $error->getCode(),
                'message' => $error->getMessage()
            ];
        }
    }

    /**
     * Function to update employee code and employee number
     * @param $result
     * @return bool
     */
    private function updateEmployeeCodeAndNumber($result)
    {
        $data = ['employee_code' => $result->id . time()];

        if ($result->employee_no === null || empty($result->employee_no) === true) {
            $data = array_merge($data, ['employee_no' => '2022-' . $result->id]);
        }

        return $this->updateEmployee($result->id, $data);
    }

    /**
     * Function to fetch employee from database
     * @param $id
     * @return Collection
     */
    public function getEmployeeById(int $id)
    {
        return $this->doFindOrFail($id);
    }

    /**
     * Function to update employee from database
     * @param $id
     * @param $data
     * @return bool
     */
    public function updateEmployee(int $id, array $data)
    {
        $result = $this->doFindOrFail($id);
        return $result->update($data);
    }

    /**
     * Function to delete employee from database
     * @param $id
     * @return bool
     */
    public function deleteEmployee(int $id)
    {
        $result = $this->doFindOrFail($id);
        $result->delete();

        $result->bankInformation()->delete();
        $result->benefit()->delete();
        $result->contact()->delete();
        $result->earning()->delete();
        $result->education()->delete();
        $result->employment()->delete();
        $result->position()->delete();
        $result->salary()->delete();
        $result->skill()->delete();
        $result->workExperience()->delete();

        return true;
    }

    /**
     * Function to check if employee work email address exists from the database
     * @param $workEmailAddress
     * @param $subDomain
     * @return int
     */
    public function checkWorkEmailAddress($workEmailAddress, $subDomain)
    {
        $tenant = Tenant::where('domain_name', $subDomain)->first();
        $tenantId = is_null($tenant) === true ? null : $tenant->id;

        $result = $this->model->where([
            'work_email_address' => $workEmailAddress,
            'tenant_id'          => $tenantId
        ])->first();


        return is_null($result) === false ? ['is_exist' => 1] : ['is_exist' => 0];
    }

    /**
     * Function to check if employee username exists from the database
     * @param $username
     * @param $subDomain
     * @return int
     */
    public function checkUsername($username, $subDomain)
    {
        $tenant = Tenant::where('domain_name', $subDomain)->first();
        $tenantId = is_null($tenant) === true ? null : $tenant->id;

        $result = $this->model->where([
            'username'  => $username,
            'tenant_id' => $tenantId
        ])->first();

        return is_null($result) === false ? ['is_exist' => 1] : ['is_exist' => 0];
    }
}
