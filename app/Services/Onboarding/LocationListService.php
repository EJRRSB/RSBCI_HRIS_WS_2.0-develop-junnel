<?php

namespace App\Services\Onboarding;

use App\Services\BaseService;
use App\Repositories\Onboarding\LocationListRepository;

use App\Constants\APIConstants as constants;
use App\Constants\ResponseConstants as responses;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class LocationListService
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class LocationListService extends BaseService
{
    /**
     * Function to instantiate LocationListRepository
     */
    public function __construct(LocationListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Function to check and fetch location list
     * @param $data
     * @return json
     */
    public function getAllLocations($data, $subdomain)
    { 
        return $this->repository->getAllLocations($data, $subdomain);
    } 
 
    public function insertLocation($data)
    {  
        error_log($data->location_code);
        $location_code = Str::random(6);
        if ($data->has('location_code')) {
            $location_code = $data->location_code;
        }
        
        $data_for_insert = [
            'tenant_id' => $data->tenant_id,
            'location_code' =>  $location_code,
            'country' => $data->country,
            'street_address' => $data->street_address,
            'province' => $data->province,
            'city' => $data->city,
            'zip_code' => $data->zip_code,
        ];

        return $this->repository->insertLocation($data_for_insert);
    } 

    public function getLocation($id)
    {  
        return $this->repository->getLocation($id);  
    }
    
    public function updateLocation($data, $id)
    {  
        $data_for_update = [
            'location_code' =>  $data->location_code,
            'country' => $data->country,
            'street_address' => $data->street_address,
            'province' => $data->province,
            'city' => $data->city,
            'zip_code' => $data->zip_code,
        ];
        return $this->repository->updateLocation($data_for_update, $id);  
    }
    
    public function deleteLocation($id)
    {  
        return $this->repository->deleteLocation($id);  
    }
    

   
}
