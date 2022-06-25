<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest; 

use App\Services\Onboarding\CompanyListService;
use App\Repositories\Onboarding\CompanyListRepository;
use Illuminate\Support\Facades\Http;



/**
 * Class CompanyListController
 * @package App\Http\Controllers\Onboarding
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.21
 */
class CompanyListController extends Controller
{
    /**
     * Function to instantiate LocationListService and Request
     * @param $repository
     */
    public function __construct(CompanyListRepository $repository)
    {
        $this->service = new CompanyListService($repository);
        $this->request = new Request();
    }

    
    /**
     * Function to fetch company list
     * @param $request
     * @return json
     */
    public function index(Request $request)
    {     
        return $this->service->getAllCompanies($request, $this->getSubDomainFromURL());  
    }

    public function store(CompanyRequest $request)
    { 
        $request->validated();
        return $this->service->insertCompany($request);        
    }
 
    public function show($id)
    {      
        return $this->service->getCompany($id);        
    }

    public function update(CompanyRequest $request, $id)
    {  
        $request->validated();
        return $this->service->updateCompany($request, $id); 
    }
    
    public function destroy($id)
    {
        return $this->service->deleteCompany($id); 
    }
}
