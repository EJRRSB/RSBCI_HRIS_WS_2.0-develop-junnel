<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest; 

use App\Services\Onboarding\DepartmentListService;
use App\Repositories\Onboarding\DepartmentListRepository;
use Illuminate\Support\Facades\Http;

/**
 * Class DepartmentListController
 * @package App\Http\Controllers\Onboarding
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.17
 */
class DepartmentListController extends Controller
{
    /**
     * Function to instantiate DepartmentListService and Request
     * @param $repository
     */
    public function __construct(DepartmentListRepository $repository)
    {
        $this->service = new DepartmentListService($repository);
        $this->request = new Request();
    }
 
    /**
     * Function to fetch department list
     * @param $request
     * @return json
     */
    public function index(Request $request)
    {     
        return $this->service->getAllDepartments($request, $this->getSubDomainFromURL());  
    }

    public function store(DepartmentRequest $request)
    { 
        $request->validated();
        return $this->service->insertDepartment($request);        
    }
 
    public function show($id)
    {      
        return $this->service->getDepartment($id);        
    }

    public function update(DepartmentRequest $request, $id)
    {  
        $request->validated();
        return $this->service->updateDepartment($request, $id); 
    }
    
    public function destroy($id)
    {
        return $this->service->deleteDepartment($id); 
    }
}
