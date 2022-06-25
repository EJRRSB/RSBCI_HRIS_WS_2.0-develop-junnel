<?php

namespace App\Http\Controllers\Onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest; 

use App\Services\Onboarding\TeamListService;
use App\Repositories\Onboarding\TeamListRepository;
use Illuminate\Support\Facades\Http;


/**
 * Class TeamListController
 * @package App\Http\Controllers\Onboarding
 * @author Elton John Romero <elton.romero@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.20
 */
class TeamListController extends Controller
{
    /**
     * Function to instantiate TeamListService and Request
     * @param $repository
     */
    public function __construct(TeamListRepository $repository)
    {
        $this->service = new TeamListService($repository);
        $this->request = new Request();
    }
    

    /**
     * Function to fetch team list asd
     * @param $request
     * @return json
     */
    public function index(Request $request)
    {     
        return $this->service->getAllTeams($request, $this->getSubDomainFromURL());  
    }

    public function store(TeamRequest $request)
    { 
        $request->validated();
        return $this->service->inserTeam($request);        
    }
 
    public function show($id)
    {      
        return $this->service->getTeam($id);        
    }

    public function update(TeamRequest $request, $id)
    {  
        $request->validated();
        return $this->service->updateTeam($request, $id); 
    }
    
    public function destroy($id)
    {
        return $this->service->deleteTeam($id); 
    }
}
