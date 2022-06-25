<?php

namespace App\Repositories\Employee;

use App\Repositories\Employee\EmployeeBaseRepository;

use App\Models\Employee\Employee;

use Exception;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EmployeeListRepository
 * @package App\Repositories
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.7
 */
class EmployeeListRepository extends EmployeeBaseRepository
{
    /**
     * Variable for default number of rows for pagination
     */
    const PAGINATION_PER_PAGE = 10;

    /**
     * Function to instantiate Employee model
     */
    public function __construct(Employee $employeeModel)
    {
        $this->model = $employeeModel;
    }

    /**
     * Function to send api request to fetch employee list
     * @param $data
     * @return mixed
     */
    public function getAllEmployees($tenantId)
    {
        try {
            return $this->model->where('tenant_id', $tenantId)->orderBy('created_at', 'DESC')->paginate(self::PAGINATION_PER_PAGE);
        } catch (Exception $error) {
            return $this->errorResponse($error);
        }
    }

    /**
     * Function to send api request to fetch employees by status
     * @param $data
     * @return mixed
     */
    public function getEmployeesByStatus(int $tenantId, int $status)
    {
        try {
            return $this->model->where(['tenant_id' => $tenantId, 'status' => $status])->orderBy('created_at', 'DESC')->paginate(self::PAGINATION_PER_PAGE);
        } catch (Exception $error) {
            return $this->errorResponse($error);
        }
    }

    /**
     * Function to send api request to update employee status
     * @param $data
     * @return mixed
     */
    public function updateStatus($id, $statusCode)
    {
        try {
            $result = $this->doFindOrFail($id);
            $result->update(['status' => $statusCode]);
            return $result;
        } catch (Exception $error) {
            return $this->errorResponse($error);
        }
    }

    /**
     * Function to return exception error
     * @param $error
     * @return array
     */
    private function errorResponse($error)
    {
        return [
            'code'    => $error->getCode(),
            'message' => $error->getMessage()
        ];
    }
}
