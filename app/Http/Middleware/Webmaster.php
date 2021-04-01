<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Webmaster
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
        //redirect home case user hasn`t auth
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        //redirect home case user isn`t admin
        $user = Auth::user();
        if(!$user->isAdmin) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
