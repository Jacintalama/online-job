<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Responses\RegisteredUserResponse;
use App\Http\Responses\LoginResponse;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                    case 'department_head': // Updated here
                        return redirect('/departmenthead/dashboard'); // Also update the route accordingly
                case 'applicant':
                    return redirect('/applicant/dashboard');
                default:
                    return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }

}
