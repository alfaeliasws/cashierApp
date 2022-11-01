<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHeaders
{
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->set('accepts', 'application/json');

        return $next($request);
    }
}
