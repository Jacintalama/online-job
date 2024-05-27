<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Job;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
{

    Log::info('Inside AdminController dashboard method');
    dd('Admin Dashboard');
    return view('admin.dashboard'); // Point this to wherever your admin dashboard view is located
}

    // Show the admin login form
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function __construct() {
        // $this->middleware('guest:admin')->except('logout');
    }

   // Handle the admin login request
   public function login(Request $request)
   {
       // Validate the request
       $request->validate([
           'email' => 'required|string|email',
           'password' => 'required|string',
       ]);

       // Attempt to authenticate the user
       if (!Auth::attempt($request->only('email', 'password'))) {
           return back()->withErrors([
               'email' => 'The provided credentials do not match our records.',
           ]);
       }

       // Ensure the authenticated user has the 'admin' role
       if (Auth::user()->role !== 'admin') {
           Auth::logout();
           return back()->withErrors([
               'email' => 'You do not have permission to access the admin dashboard.',
           ]);
       }

       // Redirect to the admin dashboard
       return redirect()->route('admin.dashboard');
   }


   public function manageUsers()
   {

    $departmentheadUsers = User::where('role', 'department_head')->with('department')->get();
    $departments = Department::all();
    // dd($lguhrmoUsers->toArray());
    return view('admin.manage.users', ['departmentheadUsers' => $departmentheadUsers, 'departments' => $departments]);

   }

    public function addDEPARTMENTHEAD(Request $request)
    {
        Log::info('addDEPARTMENTHEAD method called with data:', $request->all());

    // Validate the request data
    $request->validate([
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'department_id' => 'required|exists:departments,id',
        'first_name' => 'required|string|max:255',  // Add this line
        'middle_initial' => 'nullable|string|max:1',  // Add this line
        'last_name' => 'required|string|max:255',  // Add this line
    ]);

    // Hash the password
    $hashedPassword = Hash::make($request->password);
    $departmentName = Department::find($request->department_id)->name;

    // Create the new LGU HRMO
    $newDepartmentHead = User::create([
        'email' => $request->email,
        'password' => $hashedPassword,
        'role' => 'department_head',
        'department_head_name' => $departmentName,
        'first_name' => $request->first_name,  // Add this line
        'middle_initial' => $request->middle_initial,  // Add this line
        'last_name' => $request->last_name,  // Add this line
        // Add other necessary default fields as per your User model
    ]);
    Log::info('User Created:', $newDepartmentHead->toArray());
    // Create a welcome message
    Message::create([
        'sender_id' => 9, // or the ID of an admin user if applicable
        'recipient_id' => $newDepartmentHead ->id, // The ID of the newly created user
        'content' => 'Welcome Mabuhay GenSan! You may change your password.',

        // Add any other necessary fields
    ]);

    // Redirect to the manage users page with a success message
    return redirect()->route('admin.manage.users')->with('success', 'Department Head added successfully!');
    }




    public function manageJobs()
{

    $jobs = Job::with('department', 'user')->get(); // Eager load department and user relationships
    $user = Auth::user();
    Log::debug($jobs);
    return view('admin.manage.jobs', compact('jobs', 'user'));
}


    public function publishJob($id)
    {
    $job = Job::find($id);
    $job->status = 'published';
    $job->save();

    return redirect()->back()->with('success', 'Job published successfully!');
    }


    public function unpublishJob($id)
    {
    $job = Job::find($id);
    $job->status = 'unpublished';
    $job->save();

    return redirect()->back()->with('warning', 'Job unpublished.');
    }



    public function reports()
    {
        $jobs = Job::whereHas('user', function($query) {
            $query->where('role', 'department_head');  // assuming 'role' is the attribute to identify 'Department head'
        })->paginate(8);  // paginate to 8 results per page

        return view('admin.manage.reports', ['jobs' => $jobs]);
    }





    public function approveJob($jobId) {
        $job = Job::find($jobId);
        $job->status = 'published';
        $job->save();
        return redirect()->back()->with('success', 'Job published successfully!');
    }


    public function reportList() {
        $jobs = Job::whereHas('user', function($query) {
            $query->where('role', 'department_head');  // assuming 'role' is the attribute to identify 'Department head'
        })->get();

        return view('admin.manage.reports', ['jobs' => $jobs]);
    }





    public function deleteUser(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.manage.users')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            // Handle the error here. For simplicity, I'm redirecting with an error message.
            return redirect()->route('admin.manage.users')->with('error', 'Failed to delete user. ' . $e->getMessage());
        }
    }


}
