<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class IsEnable
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
            if(!Auth::user()->is_enable){
                if(\Request::is('api*')){
                    $request->user()->token()->revoke();
                    return response()->json([
                        'success' => false,
                        'message' => 'Your account has been blocked !'
                    ], 403);
                }else{
                    Auth::logout();
                    return redirect()->route('login')->withMessage(__('Your account has been blocked').' !');
                }
            }
        }
        return $next($request);
    }
}
