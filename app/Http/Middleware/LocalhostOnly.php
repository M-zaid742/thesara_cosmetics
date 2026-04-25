<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalhostOnly
{
    public function handle(Request $request, Closure $next)
    {
        $allowedHosts = ['localhost', '127.0.0.1', '::1'];
        $allowedIps = ['127.0.0.1', '::1'];

        if (!in_array($request->getHost(), $allowedHosts, true) && !in_array($request->ip(), $allowedIps, true)) {
            abort(403, 'Admin area is only accessible from localhost.');
        }

        return $next($request);
    }
}
