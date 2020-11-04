<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class VerifyUserIsAdministrator
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
        if(Auth::user()){
            if(!Auth::user()->hasAnyRole(['super-admin', 'shop-admin'])){
                Auth::logout();
                return redirect()->route('login')->withMessage('Le panneau de control est reservé aux admin de boutique / restaurant !');
            }
        }
        return $next($request);
    }
}
