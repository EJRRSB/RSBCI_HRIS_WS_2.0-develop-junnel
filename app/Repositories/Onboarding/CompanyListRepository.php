<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Http;

use App\Models\Onboarding\Company;
use App\Models\Onboarding\Tenant;
use App\Constants\APIConstants as constants;

/**
 * Class CompanyListRepository
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class CompanyListRepository extends BaseRepository
{
    /**
     * Function to send api request to fetch company list
     * @param $data
     * @return object
     */
    // public function getAllCompanies($data)
    // {  

    //     $url = config('app.API_URL');
    //     $endpoint = constants::COMPANY_API_ENDPOINTS['companies']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);
 
    // } 
    public function getAllCompanies($data, $subdomain)
    {   
        $tenant = Tenant::where('domain_name', $subdomain)->first();
        return Company::where('tenant_id', $tenant->id)->paginate(150);
 
    } 

    
    // public function insertCompany($data)
    // { 
    //     $url = config('app.API_URL');
    //     $endpoint = constants::COMPANY_API_ENDPOINTS['companies']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);

    //     return $this->post($url, $endpoint, $data);  
    // }

    
    public function insertCompany($data)
    {  
        $company = Company::create($data);
        return response()->json(['message' => "ok", "id" => $company->id]);
    }

    
    // public function getCompany($id, $data)
    // { 
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::COMPANY_API_ENDPOINTS['company_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);
    // }

    
    public function getCompany($id)
    { 
        $company = Company::findOrFail($id);
        $company['location_id'] = $company->location->location_code;
        return response()->json(['data' => $company]);
    }

    
    // public function updateCompany($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::COMPANY_API_ENDPOINTS['company_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->put($url, $endpoint, $data);
    // }

    
    public function updateCompany($data, $id)
    {    
        $company = Company::findOrFail($id);
        $company->update($data);
        return response()->json(['message' => "ok"]);
    }

    
    // public function deleteCompany($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::COMPANY_API_ENDPOINTS['company_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->delete($url, $endpoint);
    // }

    
    public function deleteCompany($id)
    {   
        $company = Company::findOrFail($id);
        $company->delete();
        $company->divisions()->delete();
        return response()->json(['message' => "ok"]);;
    }
    
}
