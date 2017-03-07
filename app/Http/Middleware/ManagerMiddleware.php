<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class ManagerMiddleware
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
        //1 user should be authenticated
        //2 Authenticated user should be manager
        if(Sentinel::check()&& Sentinel::getUser()->roles()->first()->slug == 'manager')
        {
            //if(Sentinel::getUser()->roles()->first()->slug == 'admin')
            //this line is default code
            //result of Log can be found at storage->logs->laravel.log
            //\Log::info('role', ['role' => Sentinel::getUser()->roles()->first()]);
            return $next($request);
        }

        else
            return redirect('/');
    }
}
