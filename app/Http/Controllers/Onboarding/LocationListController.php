<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest; 


use App\Services\Onboarding\LocationListService;
use App\Repositories\Onboarding\LocationListRepository;
use Illuminate\Support\Facades\Http;

/**
 * Class LocationListController
 * @package App\Http\Controllers\Onboarding
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.20
 */
class LocationListController extends Controller
{
    /**
     * Function to instantiate LocationListService and Request
     * @param $repository
     */
    public function __construct(LocationListRepository $repository)
    {
        $this->service = new LocationListService($repository);
        $this->request = new Request();
    }
    

    /**
     * Function to fetch location list
     * @param $request
     * @return json
     */
    public function index(Request $request)
    {        
        return $this->service->getAllLocations($request, $this->getSubDomainFromURL());
    }

    public function store(LocationRequest $request)
    {  
        $request->validated(); 
        return $this->service->insertLocation($request);        
    }
 
    public function show($id)
    {      
        return $this->service->getLocation($id);        
    }

    public function update(LocationRequest $request, $id)
    {  
        $request->validated();
        return $this->service->updateLocation($request, $id); 
    }
    
    public function destroy($id)
    {
        return $this->service->deleteLocation($id); 
    }
}
