<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $service;
    protected $request;

    protected function getSubDomainFromURL()
    {
        $url = explode('.', explode('//', url(''))[1]);
        return array_key_exists('www', array_flip($url)) === true ? $url[1] : $url[0];
    }
}
