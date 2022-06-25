<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    public function validateCompanyCode(Request $request)
    {
        return Http::withHeaders([
            'SubDomainName' => 'SubDomain ' . $this->getSubDomainFromURL(),
        ])->acceptJson()->get(env('API_URL') . '/validate/company_code/' . $request->company_code);
    }
}
