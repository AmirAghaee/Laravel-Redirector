<?php

namespace AmirAghaee\Redirector\Middleware;

use AmirAghaee\Redirector\Facades\Redirector;
use Illuminate\Support\Facades\Redirect;
use Closure;
use Illuminate\Support\Facades\URL;

class CheckRouteNeedRedirector
{
    public function handle($request, Closure $next)
    {
        if (!config('redirector.isEnable')) return $next($request);

        $allRoutes = Redirector::all();
        $requestUri = (string)$request->getRequestUri();
        $route = $allRoutes->where('source', $requestUri)->first();
        if (!$route) return $next($request);

        if (in_array($route['status'], config('redirector.status.redirect'))) {
            return Redirect::to(URL::to($route['endpoint']), $route['status']);
        } else {
            abort((int)$route['status']);
        }

        return $next($request);
    }
}
