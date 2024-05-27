<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class UserProfileController extends Controller
{
    //
    public function export($userId)
    {
        $user = User::findOrFail($userId);
       
        $pdf = PDF::loadView('pdf.profile', ['user' => $user]);
        return $pdf->download('profile.pdf');
    }
}
