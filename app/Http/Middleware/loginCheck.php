<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class loginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(auth()->user())){
            if(url()->current() == url('loginPage') || url()->current() == url('registerPage')){
                if(auth()->user()->role == 'admin'){
                    return redirect()->route('admin#dashboard');
                }elseif(auth()->user()->role == 'user'){
                    return redirect()->route('user#home');
                }
            }
        }
        return $next($request);
    }
}
