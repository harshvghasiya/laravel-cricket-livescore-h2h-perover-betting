<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontUserAuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        

        if (isset(\Auth::guard('front_user')->user()->id)) { 
            return $next($request);  
   
        }
        flashMessage('error',trans('message.login_fail'));
            return redirect()->route('front.home');
        
           }
}
