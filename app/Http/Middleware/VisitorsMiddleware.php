<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Session;

class VisitorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Sentinel::check())
            return $next($request);
        else
            //new added on 2017-03-27
            //Session::put('oldUrl', $request->url());
            return redirect('/product');
    }
}
