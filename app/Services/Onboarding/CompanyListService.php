<?php

namespace App\Services\Onboarding;

use App\Services\BaseService;
use App\Repositories\Onboarding\CompanyListRepository;

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
class CompanyListService extends BaseService
{
    /**
     * Function to instantiate CompanyListRepository
     */
    public function __construct(CompanyListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Function to check and fetch company list
     * @param $data
     * @return json
     */ 
    public function getAllCompanies($data, $subdomain)
    { 
        return $this->repository->getAllCompanies($data, $subdomain);  
    } 
 
    public function insertCompany($data)
    {  
        if ($data->id) {
            //If Post Request has ID it means its update

            return $this->updateCompany($data, $data->id);
        }

        $file_name = $this->uploadFile($data->company_logo_url);
        $datas = [
            'tenant_id' => $data->tenant_id,
            'company_logo_url' => json_encode($file_name),
            'company_name' => $data->company_name,
            'doing_business_as' => $data->doing_business_as,
            'industry' => $data->industry,
            'company_website_url' => $data->company_website_url,
            'location_id' => $data->location_id,
            'business_phone_number' => $data->business_phone_number,
            'tin' => $data->tin,
            'company_code' => Str::random(6),
        ];

        return $this->repository->insertCompany($datas);  
    } 

    public function getCompany($id)
    {  
        return $this->repository->getCompany($id);  
    }
    
    public function updateCompany($data, $id)
    {  
        $file_name = $this->uploadFile($data->company_logo_url);
        $datas = [
            'company_logo_url' => $file_name,
            'company_name' => $data->company_name,
            'doing_business_as' => $data->doing_business_as,
            'industry' => $data->industry,
            'company_website_url' => $data->company_website_url,
            'location_id' => $data->location_id,
            'business_phone_number' => $data->business_phone_number,
            'tin' => $data->tin,
            'company_code' => $data->company_code,
        ];

        return $this->repository->updateCompany($datas, $id);  
    }
    
    public function deleteCompany($id)
    {  
        return $this->repository->deleteCompany($id);  
    }

    
    //Other Functions
    public function uploadFile($file)
    { 
        if ($file) {
            $file = $file;
            $name = $file->getClientOriginalName();
            $file->move('files', $name);
            return $name;
        }
    }
   
}
