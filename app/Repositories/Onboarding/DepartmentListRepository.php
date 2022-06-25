<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;
use App\Models\Onboarding\Company;
use App\Models\Onboarding\Department;
use App\Models\Onboarding\Tenant;

use Illuminate\Support\Facades\Http;

use App\Constants\APIConstants as constants;

/**
 * Class DepartmentListRepository
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class DepartmentListRepository extends BaseRepository
{
    /**
     * Function to send api request to fetch department list
     * @param $data
     * @return object
     */
    // public function getAllDepartments($data)
    // { 
         
    //     //  return Http::withHeaders([
    //     //     'Accept' => 'application/json',
    //     //     'subDomainName' => 'SubDomain test123'
    //     //  ])->get('http://127.0.0.1:8080/api/v1/departments');
        
    //      $url = config('app.API_URL');
    //      $endpoint = constants::DEPARTMENT_API_ENDPOINTS['departments']; 
    //      $this->setSubDomainValue( $data->subDomainName()); 
    //      $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //      return $this->get($url, $endpoint);
 
    // } 
    public function getAllDepartments($data, $subdomain)
    { 
         
        $tenant = Tenant::where('domain_name', $subdomain)->first();
        $companies = Company::where('tenant_id', $tenant->id)->get(['id']);
        // $company_list = [];
        // foreach ($companies as $company) {
        //     array_push($company_list, $company->id);
        // } 
        return Department::whereIn("company_id", $companies)->with('location')->paginate(150);
 
    } 

    
    // public function insertDepartment($data)
    // { 
    //     $url = config('app.API_URL');
    //     $endpoint = constants::DEPARTMENT_API_ENDPOINTS['departments']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);

    //     return $this->post($url, $endpoint, $data);  
    // }

    
    public function insertDepartment($data)
    { 
        Department::create($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function getDepartment($id, $data)
    // { 
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::DEPARTMENT_API_ENDPOINTS['department_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);
    // }

    
    public function getDepartment($id)
    { 
        return Department::with('location')->with('division')->findOrFail($id);
    }

    
    // public function updateDepartment($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::DEPARTMENT_API_ENDPOINTS['department_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->put($url, $endpoint, $data);
    // }

    
    public function updateDepartment($data, $id)
    {   
        $department = Department::findOrFail($id);
        $department->update($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function deleteDepartment($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::DEPARTMENT_API_ENDPOINTS['department_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->delete($url, $endpoint);
    // }

    
    public function deleteDepartment($id)
    {   
        Department::findOrFail($id)->delete();
        return response()->json(['message' => "ok"]);;
    }
}
