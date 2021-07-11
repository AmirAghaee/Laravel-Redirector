<?php

namespace AmirAghaee\Redirector\Middleware;

use AmirAghaee\Redirector\Facades\Redirector;
use Illuminate\Support\Facades\Redirect;
use Closure;

class CheckRouteNeedRedirector
{
    public function handle($request, Closure $next)
    {
        if (!config('redirector.isEnable')) return $next($request);

        $allRoutes = Redirector::all();
        $requestUri = (string)$request->getRequestUri();

        if (!array_key_exists($requestUri, $allRoutes)) return $next($request);

        $route = $allRoutes[$requestUri];
        if (in_array($route['status'], config('redirector.status.redirect'))) {
            return Redirect::to($route['route'], $route['status']);
        } else {
            abort((int)$route['status']);
        }

        return $next($request);
    }
}
