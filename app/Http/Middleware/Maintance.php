<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Maintance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::check()) {
            //if user isnt admin
            $user = Auth::user();
            if(!$user->isAdmin) {
                Auth::logout();
    
                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
            }

            //if user is admin
            else if(\Route::currentRouteName() == 'login') return redirect()->route('home');
        }

        //else if user hasnt auth
        else 
            if(\Route::currentRouteName() != 'login')
                return redirect()->route('login');

        return $next($request);
    }
}