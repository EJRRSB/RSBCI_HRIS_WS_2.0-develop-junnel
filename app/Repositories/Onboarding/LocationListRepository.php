<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;

use Illuminate\Support\Facades\Http;

 
use App\Http\Requests\LocationRequest; 
use App\Models\Onboarding\Location;
use App\Models\Onboarding\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 

use App\Constants\APIConstants as constants;

/**
 * Class LocationListRepository
 * @package App\Repositories
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class LocationListRepository extends BaseRepository
{
    /**
     * Function to send api request to fetch location list
     * @param $data
     * @return object
     */
    // public function getAllLocations($data)
    // {  

    //     $url = config('app.API_URL');
    //     $endpoint = constants::LOCATION_API_ENDPOINTS['locations']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);  
    // }  

    public function getAllLocations($data, $subdomain)
    {     
        $tenant = Tenant::where('domain_name', $subdomain)->first();
        return Location::where('tenant_id', $tenant->id)->paginate(15);
    } 

    
    // public function insertLocation($data)
    // { 
    //     $url = config('app.API_URL');
    //     $endpoint = constants::LOCATION_API_ENDPOINTS['locations']; 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);

    //     return $this->post($url, $endpoint, $data);  
    // }

    
    public function insertLocation($data)
    {     
        Location::create($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function getLocation($id, $data)
    // { 
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::LOCATION_API_ENDPOINTS['location_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->get($url, $endpoint);
    // }

    
    public function getLocation($id)
    { 
        return Location::findOrFail($id);
    }

    
    // public function updateLocation($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::LOCATION_API_ENDPOINTS['location_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->put($url, $endpoint, $data);
    // }

    
    public function updateLocation($data, $id)
    {     
        $location = Location::findOrFail($id);
        $location->update($data);
        return response()->json(['message' => 'ok']);
    }

    
    // public function deleteLocation($data, $id)
    // {   
    //     $url = config('app.API_URL'); 
    //     $endpoint = sprintf(constants::LOCATION_API_ENDPOINTS['location_show'], (int)$id); 
    //     $this->setSubDomainValue( $data->subDomainName()); 
    //     $this->setHeader([constants::SUB_DOMAIN_NAME_KEY => $this->getSubDomainValue()]);
 
    //     return $this->delete($url, $endpoint);
    // }

    
    public function deleteLocation($id)
    {   
        Location::findOrFail($id)->delete();
        return response()->json(['message' => "ok"]);;
    }
}
