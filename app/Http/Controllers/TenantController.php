<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TenantController extends Controller
{
    public function validateTenantName()
    {

        return Http::withHeaders([
            'SubDomainName' => 'SubDomain ' . $this->getSubDomainFromURL(),
        ])->acceptJson()->get(config('app.API_URL') . '/api/v1/validate/domain_name/' . $this->getSubDomainFromURL());
    }
}
