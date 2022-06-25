<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UseController extends Controller
{
    public function validateWorkEmail(Request $request)
    {
        return Http::withHeaders([
            'SubDomainName' => 'SubDomain'  . $this->getSubDomainFromURL(),
        ])->acceptJson()->get(config('app.API_URL') . '/api/v1/validate/work_email_addess/' . $request->work_email_address);
    }
    public function validateUsername(Request $request)
    {
        return Http::withHeaders([
            'SubDomainName' =>
            'SubDomain ' . $this->getSubDomainFromURL(),
        ])->acceptJson()->get(config('app.API_URL') . '/api/v1/validate/username/' . $request->username);
    }
}
