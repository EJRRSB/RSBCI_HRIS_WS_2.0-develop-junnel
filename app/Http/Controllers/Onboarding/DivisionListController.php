<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DivisionRequest; 

use App\Services\Onboarding\DivisionListService;
use App\Repositories\Onboarding\DivisionListRepository;
use Illuminate\Support\Facades\Http;


class DivisionListController extends Controller
{ 
    
    /**
     * Function to instantiate DivisionListService and Request
     * @param $repository
     */
    public function __construct(DivisionListRepository $repository)
    {
        $this->service = new DivisionListService($repository);
        $this->request = new Request();
    }

    
    /**
     * Function to fetch division list asd
     * @param $request
     * @return json
     */
    public function index(Request $request)
    {      
        return $this->service->getAllDivisions($request, $this->getSubDomainFromURL());  
    }

    public function store(DivisionRequest $request)
    {         
        $request->validated();
        return $this->service->insertDivision($request);  
    }
 
    public function show($id)
    {          
        return $this->service->getDivision($id);    
    }

    public function update(DivisionRequest $request, $id)
    {   
        $request->validated();
        return $this->service->updateDivision($request, $id); 
    }
    
    public function destroy($id)
    { 
        return $this->service->deleteDivision($id); 
    }
}
