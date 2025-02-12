<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        // Força que la petició s'interpreti com a API
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
