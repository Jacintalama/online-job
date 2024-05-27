<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployerApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if ($request->user() && $request->user()->role === 'employer' && !$request->user()->is_approved) {
        return redirect('/dashboard')->with('error', 'Your account is awaiting approval by an admin.');
    }

    return $next($request);
}
}
