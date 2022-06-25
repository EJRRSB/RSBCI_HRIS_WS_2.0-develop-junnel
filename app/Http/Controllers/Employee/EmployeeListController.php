<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Employee\EmployeeListService;
use App\Repositories\Employee\EmployeeListRepository;

use App\Models\Employee\Employee;

use App\Libraries\ResponseLibrary;
use App\Constants\ResponseConstants as responses;

class EmployeeListController extends Controller
{
    /**
     * Function to instantiate EmployeeListService
     */
    public function __construct()
    {
        $this->service = new EmployeeListService(new EmployeeListRepository(new Employee()));
    }

    /**
     * Function to fetch employee list
     * @param $request
     * @return json
     */
    public function getAllEmployees(Request $request)
    {
        $result = $this->service->getAllEmployees($request->get('tenant_id'));
        
        return $result[responses::RESULT] === responses::FAIL ? 
            ResponseLibrary::errorResponse($result[responses::MESSAGE], $result[responses::STATUS_CODE]) : 
            ResponseLibrary::successResponse(responses::MESSAGE_OK, $result[responses::DATA]);
    }

    /**
     * Function to fetch employees by status
     * @param $status
     * @return json
     */
    public function getEmployeesByStatus(Request $request, $status)
    {
        $result = $this->service->getEmployeesByStatus($request->get('tenant_id'), $status);
        
        return $result[responses::RESULT] === responses::FAIL ? 
            ResponseLibrary::errorResponse($result[responses::MESSAGE], $result[responses::STATUS_CODE]) : 
            ResponseLibrary::successResponse(responses::MESSAGE_OK, $result[responses::DATA]);
    }

    /**
     * Function to update employee status
     * @param $id
     * @param $statusCode
     * @return json
     */
    public function updateStatus($id, $statusCode)
    {
        $result = $this->service->updateStatus($id, $statusCode);

        return $result[responses::RESULT] === responses::FAIL ? 
            ResponseLibrary::errorResponse($result[responses::MESSAGE], $result[responses::STATUS_CODE]) : 
            ResponseLibrary::successResponse(responses::MESSAGE_OK, $result[responses::DATA]);
    }
}
