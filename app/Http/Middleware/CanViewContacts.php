<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanViewContacts
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->canViewContacts()) {
            abort(403);
        }

        return $next($request);
    }
}
