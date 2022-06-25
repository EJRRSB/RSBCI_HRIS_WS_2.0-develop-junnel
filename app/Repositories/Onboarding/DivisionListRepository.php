<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Http;

use App\Http\Requests\DivisionRequest;
use App\Models\Onboarding\Company;
use App\Models\Onboarding\Division;
use App\Models\Onboarding\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Constants\APIConstants as constants;

/**
 * Class DepartmentListRepository
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class DivisionListRepository extends BaseRepository
{
    /**
     * Function to send api request to fetch employee list
     * @param $data
     * @return object
     */ 
    // public function getAllDivisions($data)
    // { 
          
    //     $url = config('app.API_URL');
    //     $endpoint = constants::DDIVISION_API_ENDPOINTS['divisions']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);

    //     return $this->get($url, $endpoint);
 
    // } 
    public function getAllDivisions($data, $subdomain)
    { 
          
        $tenant = Tenant::where('domain_name', $subdomain)->first();
        $companies = Company::where('tenant_id', $tenant->id)->get(['id']);
        // $company_list = [];
        // foreach ($companies as $company) {
        //     array_push($company_list, $company->id);
        // }
        return Division::whereIn("company_id", $companies)->with('location')->paginate(150);
 
    } 
    

    // public function insertDivision($data)
    // { 
          
    //     $url = config('app.API_URL');
    //     $endpoint = constants::DDIVISION_API_ENDPOINTS['divisions']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]); 

    //     return $this->post($url, $endpoint, $data);  
 
    // } 
    

    public function insertDivision($data)
    { 
          
        Division::create($data);
        return response()->json(['message' => 'ok']);  
 
    } 

    
    // public function getDivision($id, $data)
    // { 
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::DDIVISION_API_ENDPOINTS['division_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);
    // }

    
    public function getDivision($id)
    { 
        $division = Division::with('location')->findOrFail($id);
        return $division;
    }

    
    // public function updateDivision($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::DDIVISION_API_ENDPOINTS['division_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->put($url, $endpoint, $data);
    // }

    
    public function updateDivision($data, $id)
    {   
        $division = Division::findOrFail($id);
        $division->update($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function deleteDivision($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::DDIVISION_API_ENDPOINTS['division_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->delete($url, $endpoint);
    // }

    
    public function deleteDivision($id)
    {   
        Division::findOrFail($id)->delete();
        return response()->json(['message' => "ok"]);
    }
}
