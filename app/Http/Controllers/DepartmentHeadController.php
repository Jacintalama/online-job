<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Message;
use App\Models\ApplicantRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;


class DepartmentHeadController extends Controller
{
    public function dashboard()
    {
        $jobs = Job::where('status', 'closed')->get();

        $user = Auth::user(); // Retrieve the authenticated user
        $departmentName = optional($user->department)->name ?? 'DEPARTMENTHEAD'; // Retrieve the user's department name, or use 'DEPARTMENT HEAD' as a default

        $jobs = Job::where('department_head_id', $user->id)->orderBy('created_at', 'desc')->paginate(6);

        return view('departmenthead.dashboard', ['jobs' => $jobs, 'departmentName' => $departmentName]);
    }


    public function getEntityCount($entity)
    {
    try {
        // Return the count of entities in the table
        return $entity::count();
    } catch (\Exception $e) {
        // Log the exception message
        Log::error('Error fetching entity count: ' . $e->getMessage());

        // You might return null or throw a custom exception,
        // or handle this situation in another way that's appropriate for your application
        return null;
    }
    }



    public function showApplicants(Job $job)
{
      // Set the current job ID in session
      session(['current_job_id' => $job->id]);
    $threshold = 0.7 * $job->max_score;

    Log::info("Threshold for Job ID {$job->id}: {$threshold}");
    // Get all applicants and add an 'is_qualified' flag to each one.
    $applicants = $job->applications->map(function ($applicant) use ($threshold) {
        $applicant->is_qualified = $applicant->matching_score >= $threshold;
        return $applicant;
    });



    // Sort applicants by matching_score in descending order.
    $sortedApplicants = $applicants->sortByDesc('matching_score');

    return view('departmenthead.applicants', compact('sortedApplicants', 'job'));
}

public function updateStatus($applicantId, $jobId, $status)
{
    Log::info("updateStatus method called with applicantId: $applicantId and status: $status");

    if (!auth()->check() || auth()->user()->role != 'department_head') {
        return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
    }

    // Validation
    if (!in_array($status, ['hired', 'not_hired'])) {
        return response()->json(['success' => false, 'message' => 'Invalid status provided.'], 400);
    }

    // Find or create a record for this applicant and job
    $record = ApplicantRecord::firstOrCreate([
        'user_id' => $applicantId,
        'job_id' => $jobId
    ]);

    // Update the status
    $record->status = $status;
    $record->save();

     // Fetch the applicant's details
     $applicant = User::find($applicantId);
     $applicantName = $applicant->first_name . ' ' . $applicant->last_name;

    // After status update, send a message to the applicant
    if ($status == 'hired') {
        Message::create([
            'sender_id' => auth()->id(), // ID of the current logged in user (HRMO)
            'recipient_id' => $applicantId, // The ID of the applicant
            'content' => 'Congratulations, ' . $applicantName . '!You have been hired for the position and rest asure one our HR will contact you for further processing.',
            // Add any other necessary fields
        ]);

        // Also, mark the applicant's applications for other jobs as 'not_hired'
        ApplicantRecord::where('user_id', $applicantId)
                   ->where('job_id', '<>', $jobId)
                   ->update(['status' => 'not_hired']);
    } elseif ($status == 'not_hired') {
        Message::create([
            'sender_id' => auth()->id(), // ID of the current logged in user (HRMO)
            'recipient_id' => $applicantId, // The ID of the applicant
            'content' => 'We regret to inform you, ' . $applicantName . ', that your application was not successful this time.',
            // Add any other necessary fields
        ]);
    }

    return response()->json(['success' => true]);
}








    // // Controller Method
    // public function downloadCv($filename)
    // {
    //     try {
    //     $pathToFile = storage_path("app/cvs/{$filename}");

    //     // Check if the file exists
    //     if (!File::exists($pathToFile)) {
    //         // Log the error and return a response or view
    //         Log::error("File not found: {$pathToFile}");
    //         return response()->json(['error' => 'File not found!'], 404);
    //     }

    //     // Return the file as a download response
    //     return response()->download($pathToFile);
    //     } catch (\Exception $e) {
    //     // Log the exception and return a response or view
    //     Log::error("Error downloading file: {$e->getMessage()}");
    //     return response()->json(['error' => 'Error downloading file!'], 500);
    //     }
    // }

















}
