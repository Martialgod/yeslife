<?php

namespace App\Http\Middleware;

use Closure;


use Illuminate\Support\Facades\Auth; //responsible for our authentication 


class AdminPageAuth
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
        //check for Admin users
        if( Auth::user()->fk_usertype != '1000' )
        {
            return redirect('/');
        }


        return $next($request);
    }
}
