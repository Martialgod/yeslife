<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 


class LandingPageAuth
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
        
        //check for authenticated user
        if( !Auth::check() )
        {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
