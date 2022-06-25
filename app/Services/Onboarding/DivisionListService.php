<?php

namespace App\Services\Onboarding;

use App\Services\BaseService;
use App\Repositories\Onboarding\DivisionListRepository;

use App\Constants\APIConstants as constants;
use App\Constants\ResponseConstants as responses;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class DivisionListService
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class DivisionListService extends BaseService
{
    /**
     * Function to instantiate DivisionListRepository
     */
    public function __construct(DivisionListRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Function to check and fetch employee list
     * @param $data
     * @return json
     */ 
    public function getAllDivisions($data, $subdomain)
    { 
        return $this->repository->getAllDivisions($data, $subdomain);  
    } 
 
    public function insertDivision($data)
    {  
        $data_for_insert = [
            'company_id' => $data->company_id,
            'location_id' => $data->location_id,
            'division_code' => Str::random(6),
            'division_name' => $data->division_name,
            'division_head' => $data->division_head,
        ];

        return $this->repository->insertDivision($data_for_insert);  
    } 
 
    public function getDivision($id)
    {  
        return $this->repository->getDivision($id);  
    }
    
    public function updateDivision($data, $id)
    {  
        $data_for_update = [
            'company_id' => $data->company_id,
            'location_id' => $data->location_id,
            //'division_code' => $request->division_code,
            'division_name' => $data->division_name,
            'division_head' => $data->division_head,
        ];
        return $this->repository->updateDivision($data_for_update, $id);  
    }
    
    public function deleteDivision($id)
    {  
        return $this->repository->deleteDivision($id);  
    }
    

   
}
