<?php

namespace App\Http\Middleware;

use Closure;

class VerifyIsEmployee
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
        if(!auth()->user()->isAdmin() or !auth()->user()->isEmployee()){
            return redirect()->back();
        }
        return $next($request);
    }
}
