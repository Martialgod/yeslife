<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 


class IsSuperAdmin
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

        //check for super admin
        if( Auth::id() != 1000 )
        {
            return redirect('/admin/home');
        }
 

        return $next($request);
    }
}
