<?php

namespace App\Http\Middleware;


use Closure;
use Auth;

class CheckUserType
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
         if (Auth::user() && Auth::user()->type == 2) {
            return $next($request);
         }

         return redirect('/admin/login');
    }
}
