<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Employee\ProfileRequest;

use App\Models\Employee\Employee;
use App\Models\Company;
use App\Models\Tenant;
use App\Models\Lookup;

use App\Services\Employee\ProfileService;
use App\Services\Onboarding\CompanyService;
use App\ServicesOnboarding\TenantService;

use App\Repositories\Employee\ProfileRepository;
use App\Repositories\Onboarding\CompanyRepository;
use App\Repositories\Onboarding\TenantRepository;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

use App\Libraries\ResponseLibrary;
use App\Constants\ResponseConstants;
use App\Constants\EmployeeConstants as constants;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Employee
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.11
 */
class ProfileController extends Controller
{
    /**
     * Function to instantiate ProfileRepository
     */
    public function __construct()
    {
        $this->service = new ProfileService(new ProfileRepository(new Employee()));
    }

    /**
     * Function to fetch lookup data
     * @param $request
     * @return Collection
     */
    public function getLookupData(Request $request)
    {
        return Lookup::where('attribute_type', $request->attribute_type)->get();
    }

    public function index(Request $request)
    {
        // try {
        //     return ResponseLibrary::successResponse($this->repository->getAllEmployeeByTenant($request->tenant_id));
        // } catch (Exception $oError) {
        //     error_log($oError);
        //     return ResponseLibrary::errorResponse($oError->getMessage(), $oError->getCode());
        // }
    }

    /**
     * Function to store employee profile information
     * @param $request
     * @return JsonResponse
     */
    public function store(ProfileRequest $request)
    {
        $request->validated();

        if ($request->id) {
            return $this->update($request, $request->id);
        }

        $result = $this->service->storeProfile($request);
        return $this->returnResponse($result);
    }

    // /**
    //  * Function to fetch employee by id
    //  * @param $id
    //  * @return JsonResponse
    //  */
    // public function show($id)
    // {
    //     try {
    //         return ResponseLibrary::successResponse($this->repository->getEmployeeById($id));
    //     } catch (Exception $oError) {
    //         return ResponseLibrary::errorResponse(ResponseConstants::EMPLOYEE_NOT_FOUND, ResponseConstants::NOT_FOUND_ERROR_CODE);
    //     }
    // }

    /**
     * Function to update employee
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    private function update($request, $id)
    {
        $request->validated();

        $data = $request->all();
        unset($data['id']);

        $result = $this->service->updateEmployee($data, $id);
        return $this->returnResponse($result);
    }

    private function returnResponse($result)
    {
        return $result['result'] === 'Failed' ? 
            ResponseLibrary::errorResponse($result['message'], $result['code']) : 
            ResponseLibrary::successResponse($result['message']);
    }

    // /**
    //  * Function to delete employee
    //  * @param $id
    //  * @return JsonResponse
    //  */
    // public function destroy($id)
    // {
    //     try {
    //         return ResponseLibrary::successResponse($this->repository->deleteEmployee($id));
    //     } catch (Exception $oError) {
    //         return ResponseLibrary::errorResponse(ResponseConstants::EMPLOYEE_DELETE_FAIL, ResponseConstants::NOT_FOUND_ERROR_CODE);
    //     }
    // }

    // /**
    //  * Function to check if company code exists
    //  * @param $company_code
    //  * @return JsonResponse
    //  */
    // public function checkCompanyCode($companyCode)
    // {
    //     try {
    //         return ResponseLibrary::successResponse($this->companyRepository->checkCompanyCode('company_code', $companyCode));
    //     } catch (Exception $oError) {
    //         return ResponseLibrary::errorResponse(ResponseConstants::CHECK_COMPANY_EXIST_ERROR, ResponseConstants::NOT_FOUND_ERROR_CODE);
    //     }
    // }

    // /**
    //  * Function to check if employee work email address exists
    //  * @param $subDomain
    //  * @param $workEmailAddress
    //  * @return JsonResponse
    //  */
    // public function checkWorkEmailAddress($subDomain, $workEmailAddress)
    // {

    //     try {
    //         return ResponseLibrary::successResponse($this->repository->checkWorkEmailAddress($workEmailAddress, $subDomain));
    //     } catch (Exception $oError) {
    //         return ResponseLibrary::errorResponse(ResponseConstants::CHECK_WORK_EMAIL_ADDRESS_EXIST_ERROR, ResponseConstants::NOT_FOUND_ERROR_CODE);
    //     }
    // }

    // /**
    //  * Function to check if employee username exists
    //  * @param $subDomain
    //  * @param $username
    //  * @return JsonResponse
    //  */
    // public function checkUsername($subDomain, $username)
    // {
    //     try {
    //         return ResponseLibrary::successResponse($this->repository->checkUsername($username, $subDomain));
    //     } catch (Exception $oError) {
    //         return ResponseLibrary::errorResponse(ResponseConstants::CHECK_USERNAME_EXIST_ERROR, ResponseConstants::NOT_FOUND_ERROR_CODE);
    //     }
    // }
}
