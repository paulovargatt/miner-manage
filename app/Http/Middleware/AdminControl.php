<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminControl
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->type != 10) {
            return abort(403, "Sem permissão para acessar!");
        }
        return $next($request);
    }
}
