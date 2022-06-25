<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Http;

use App\Models\Onboarding\Tenant;
use App\Models\Onboarding\Company;
use App\Models\Onboarding\Team;

use App\Constants\APIConstants as constants;

/**
 * Class TeamListRepository
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class TeamListRepository extends BaseRepository
{
    /**
     * Function to send api request to fetch team list
     * @param $data
     * @return object
     */
    // public function getAllTeams($data)
    // {  

    //      $url = config('app.API_URL');
    //      $endpoint = constants::TEAM_API_ENDPOINTS['teams']; 
    //      $this->setSubDomainValue( $data->subDomainName()); 
    //      $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //      return $this->get($url, $endpoint);
 
    // } 
    public function getAllTeams($data, $subdomain)
    {  
        $tenant = Tenant::where('domain_name', $subdomain)->first();
        $companies = Company::where('tenant_id', $tenant->id)->get(['id']);
        // $company_list = [];
        // foreach ($companies as $company) {
        //     array_push($company_list, $company->id);
        // }
        return Team::whereIn("company_id", $companies)->with('location')->paginate(15); 
    } 

    
    // public function inserTeam($data)
    // { 
    //     $url = config('app.API_URL');
    //     $endpoint = constants::TEAM_API_ENDPOINTS['teams']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);

    //     return $this->post($url, $endpoint, $data);  
    // }

    
    public function inserTeam($data)
    {  
        Team::create($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function getTeam($id, $data)
    // { 
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::TEAM_API_ENDPOINTS['team_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);
    // }

    
    public function getTeam($id)
    { 
        $team = Team::with('location')->with('division')->with('department')->findOrFail($id);
        return $team;
    }

    
    // public function updateTeam($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::TEAM_API_ENDPOINTS['team_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->put($url, $endpoint, $data);
    // }

    
    public function updateTeam($data, $id)
    {    
        $team = Team::findOrFail($id);
        $team->update($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function deleteTeam($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::TEAM_API_ENDPOINTS['team_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->delete($url, $endpoint);
    // }

    
    public function deleteTeam($id)
    {   
        Team::findOrFail($id)->delete();
        return response()->json(['message' => "ok"]);;
    }
    
}
