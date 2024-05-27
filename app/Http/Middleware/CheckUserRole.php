<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
{
    // If the user is not authenticated, redirect them to the general login page
    if (!$request->user()) {
        return redirect('/login');
    }

    // // If the user's role is 'employer' and they are not approved yet, redirect them to the approval-pending page
    // if ($request->user()->role === 'employer' && !$request->user()->is_approved) {
    //     return redirect('/approval-pending');
    // }

    // Check if the user's role matches the role required by the route
    if ($request->user()->role !== $role) {
        switch ($request->user()->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            // case 'employer':
            //     return redirect('/employer/dashboard');
            case 'applicant':
                return redirect('/applicant/dashboard');
            default:
                abort(403, 'Unauthorized action.');
        }
    }

    return $next($request);
}




}
