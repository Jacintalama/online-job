<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\ApplicantRecord;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{

    public function dashboard()
    {
        $jobs = Job::where('status', 'published')->get();
        $appliedJobIds = Auth::user()->applications()->pluck('job_id')->toArray();
        $total_applied_jobs = JobApplication::where('user_id', auth()->id())->count();
        $appliedJobs = JobApplication::where('user_id', auth()->id())->get();
         // Calculate the number of hired and rejected jobs for the logged-in applicant
        $hired_jobs_count = ApplicantRecord::where('user_id', auth()->id())
                                        ->where('status', 'hired')
                                        ->count();

        $rejected_jobs_count = ApplicantRecord::where('user_id', auth()->id())
                                        ->where('status', 'not_hired')
                                        ->count();
        

    return view('applicant.dashboard', compact('jobs', 'appliedJobIds', 'total_applied_jobs', 'appliedJobs', 'hired_jobs_count', 'rejected_jobs_count'));
    }



    public function applicant_applications()
    {

        $jobs = Job::where('status', 'published')->get();

        return view('applicant.applications', compact('jobs'));
    }

    public function applications()
    {
        $appliedJobs = DB::table('job_applications')
        ->join('jobs', 'job_applications.job_id', '=', 'jobs.id')
        ->where('job_applications.user_id', auth()->id())
        ->get();

        return view('applicant.applications', compact('appliedJobs'));
    }
    public function bookmarkView()
    {
        $bookmarkedJobs = auth()->user()->bookmarks->map(function ($bookmark) {
        return $bookmark->job;
        });

        return view('applicant.bookmark-view', compact('bookmarkedJobs'));
    }












}
