<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsSuperuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Assuming your user model has an 'isSuperuser' property or method
        if ($request->user() && $request->user()->isSuperuser()) {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
    }
}
