<?php

namespace App\Services\Onboarding;

use App\Services\BaseService;
use App\Repositories\Onboarding\TeamListRepository;

use App\Constants\APIConstants as constants;
use App\Constants\ResponseConstants as responses;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class TeamListService
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class TeamListService extends BaseService
{
    /**
     * Function to instantiate TeamListRepository
     */
    public function __construct(TeamListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Function to check and fetch team list
     * @param $data
     * @return json
     */
    public function getAllTeams($data, $subdomain)
    { 
        return $this->repository->getAllTeams($data, $subdomain);  
    }  
 
    public function inserTeam($data)
    {  
        $data_for_insert = [
            'company_id' => $data->company_id,
            'location_id' => $data->location_id,
            'division_id' => $data->division_id,
            'department_id' => $data->department_id,
            'team_code' => Str::random(6),
            'team_name' => $data->team_name,
            'team_lead' => $data->team_lead,
        ];
        return $this->repository->inserTeam($data_for_insert);  
    } 

    public function getTeam($id)
    {  
        return $this->repository->getTeam($id);  
    }
    
    public function updateTeam($data, $id)
    {  
        $data_for_update = [
            'company_id' => $data->company_id,
            'location_id' => $data->location_id,
            'division_id' => $data->division_id,
            'department_id' => $data->department_id,
            'team_code' =>
            Str::random(6),
            'team_name' => $data->team_name,
            'team_lead' => $data->team_lead,
        ];
        return $this->repository->updateTeam($data_for_update, $id);  
    }
    
    public function deleteTeam($id)
    {  
        return $this->repository->deleteTeam($id);  
    }
        
   
}
