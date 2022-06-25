<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\ProfileRequest;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {

        return Http::withHeaders([
            'SubDomainName' => 'SubDomain ' . $this->getSubDomainFromURL(),
        ])->acceptJson()->post(config('app.API_URL'). '/api/v1/employee/profiles/detailed', $request);
    }
}
