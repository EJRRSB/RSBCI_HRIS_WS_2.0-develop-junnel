<?php

namespace App\Services\Onboarding;

use App\Services\BaseService;
use App\Repositories\Onboarding\DepartmentListRepository;

use App\Constants\APIConstants as constants;
use App\Constants\ResponseConstants as responses;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class DepartmentListService
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class DepartmentListService extends BaseService
{
    /**
     * Function to instantiate DepartmentListRepository
     */
    public function __construct(DepartmentListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Function to check and fetch employee list
     * @param $data
     * @return json
     */
    public function getAllDepartments($data, $subdomain)
    { 
        return $this->repository->getAllDepartments($data, $subdomain);  
    } 
 
    public function insertDepartment($data)
    {  
        $data_for_insert = [
            'company_id' => $data->company_id,
            'location_id' => $data->location_id,
            'division_id' => $data->division_id,
            'department_code' => Str::random(6),
            'department_name' => $data->department_name,
            'department_head' => $data->department_head,
        ];
        return $this->repository->insertDepartment($data_for_insert);  
    } 

    public function getDepartment($id)
    {  
        return $this->repository->getDepartment($id);  
    }
    
    public function updateDepartment($data, $id)
    {  
        $data_for_update = [
            'company_id' => $data->company_id,
            'location_id' => $data->location_id,
            'division_id' => $data->division_id,
            'department_code' => Str::random(6),
            'department_name' => $data->department_name,
            'department_head' => $data->department_head,
        ];
        return $this->repository->updateDepartment($data_for_update, $id);  
    }
    
    public function deleteDepartment($id)
    {  
        return $this->repository->deleteDepartment($id);  
    }

   
}
