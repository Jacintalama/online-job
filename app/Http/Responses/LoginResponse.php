<?php

namespace App\Http\Responses;


use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {





        $home = '/dashboard'; // default route

        if (auth()->user()->role === 'department_head') { // Updated here
            $home = '/departmenthead/dashboard'; // Also update the route accordingly
        } elseif (auth()->user()->role === 'applicant') {
            $home = '/';
        } elseif (auth()->user()->role === 'admin') {
            $home = '/admin/dashboard';
        }


        return redirect($home);

    }
}
