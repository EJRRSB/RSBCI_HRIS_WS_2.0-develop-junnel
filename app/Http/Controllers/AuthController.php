<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return Http::withHeaders([
            'SubDomainName' => 'SubDomain ' . $this->getSubDomainFromURL(),
        ])->acceptJson()->post(env('API_URL') . '/api/v1/login', $request);
    }

    public function changePassword(Request $request)
    {
        return Http::withHeaders([
            'SubDomainName' => 'SubDomain ' . $this->getSubDomainFromURL(),
        ])->acceptJson()->put(env('API_URL') . '/api/v1/password', $request);
    }
}
