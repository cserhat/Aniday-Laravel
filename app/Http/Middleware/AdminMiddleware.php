<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware 
{
    public function handle($request, Closure $next)
    {
        if(session('user_role') != 'Admin'){
            return redirect('/');
        }
        return $next($request);
    }
}