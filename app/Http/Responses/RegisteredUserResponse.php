<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisteredUserResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        // Custom redirection based on role
        if ($request->user()->role === 'employer') {
            return redirect('/employer/dashboard');
        } elseif ($request->user()->role === 'applicant') {
            return redirect('/applicant/dashboard');
        } 

        return redirect('/dashboard');
    }
}
