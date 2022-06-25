<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class CheckSubDomainName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = explode('.', explode('//', url(''))[1]);
        $subDomain =  array_key_exists('www', array_flip($url)) === true ? $url[1] : $url[0];

        //Check if Sub domain exist if yes get the id and assigned it to tenant_id as reference
        $tenant = Tenant::where('domain_name', $subDomain)->firstOrFail();

        if ($subDomain && $tenant) {
            $defaultConfig = config(('database.connections.tenant'));
            $defaultConfig['database'] = 'rsbci_chronos_tenant_test'; //Use the ff below
            //rsbcwhou_rsbci_chronos_tenant_test  <-- Live
            //rsbci_chronos_tenant_test  <-- Local
            $request->merge(["tenant_id" => $tenant->id]);
            config(['database.connections.tenant' => $defaultConfig]);
        } else {
            return response()->json(["message" => "No records found"]);
        }

        return $next($request);
    }
}
