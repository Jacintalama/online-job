<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator; // Ensure Validator is imported
use Livewire\WithFileUploads;
use Barryvdh\DomPDF;
use Dompdf\Options;

use PDF;
class JobApplicationController extends Controller
{
    use WithFileUploads;
    public function store(Request $request, Job $job)
    {

        // Validate incoming request data

        //  // Check the current count of hired applicants
        //  $currentApplicationsCount = JobApplication::where('job_id', $job->id)->count();
        //  // Check against the maximum
        //  if ($currentApplicationsCount >= $job->number_of_applicants_to_hire) {
        //     return redirect()->back()->withErrors(['error' => 'Sorry, the position has been filled.']);
        // }

        // Store the uploaded CV and get the file path

       // Log the extracted name and extension for debugging
       $matchingScore = $this->calculateMatchingScore($request->user(), $job);
       Log::info("Matching Score: {$matchingScore}");
       $threshold = 0.7 * $job->max_score;  // Calculate the threshold
       Log::info("Threshold: {$threshold}");
        // Create a new job application record
        $application = new JobApplication([
            'user_id' => Auth::id(),

            // 'status' => 'applied',  // Initial status set here
        ]);


       // Set the status using the ternary statement
       Log::info("Before determining application status for User ID {$application->user_id}");
        $application->status = $matchingScore >= $threshold ? 'qualified' : 'nonqualified';
        Log::info("Determined Application Status for User ID {$application->user_id}: {$application->status}");
        // Associate the application with the job and the user
        $application->job()->associate($job);
        $application->user()->associate($request->user());

        // Save the application to the database
        $application->save();

        // Redirect back with a success message
        return redirect()->route('jobs.show', $job)->with('success', 'Application submitted!');
    }

    public function show(Job $job)
    {
        // Calculate the number of hired applicants
        $currentHiredCount = JobApplication::where('job_id', $job->id)->where('status', 'hired')->count();

        // Check if the user has applied for this job
        $hasApplied = JobApplication::where('user_id', Auth::id())->where('job_id', $job->id)->exists();

        // Return the view with variables
        return view('applicant.jobs.details', [
            'job' => $job,
            'hasApplied' => $hasApplied,
            'currentHiredCount' => $currentHiredCount, // Pass the variable to the view
        ]);
    }
//  ALGORITHM METHOD
    public function apply(Request $request, Job $job)
    {
        $applicant = $request->user();
        $matchingScore = $this->calculateMatchingScore($applicant, $job);

        $application = new JobApplication([
            'user_id' => $applicant->id,
            'job_id' => $job->id,
            'matching_score' => $matchingScore,
        ]);

        $job->applications()->save($application);

        return redirect()->back()->with('status', 'Application submitted successfully!');
    }
    private function calculateMatchingScore(User $user, Job $job)
    {
    $score = 0;
    $degreeHierarchy = [
        'Elementary UnderGraduate' => 1,
        'Elementary Graduate' => 2,
        'HighSchool UnderGraduate' => 3,
        'HighSchool Graduate' => 4,
        'College UnderGraduate' => 5,
        'College Graduate' => 6,
        'Bachelor\'s Degree' => 7,
        'Master\'s Degree' => 8,
        'Doctorate' => 9,
    ];
    foreach ($job->qualifications as $qualification) {
        $qualificationScore = 0;  // Initialize a variable to store the score for the current qualification

        switch ($qualification->type) {
            case 'experience':
                // Convert user experience and job requirement to months.
                $userExperienceMonths = $this->convertExperienceToMonths($user->job_experience);
                $requiredExperienceMonths = $this->convertExperienceToMonths($qualification->requirement);

                // Compare the values.
                if ($userExperienceMonths >= $requiredExperienceMonths) {
                    $qualificationScore = $qualification->priority_score;
                }

                Log::info("Experience Qualification: Requirement={$qualification->requirement}, User Value={$user->job_experience}, Score={$qualificationScore}");
                break;

                case 'degree':
                    if (isset($degreeHierarchy[$user->degree]) && isset($degreeHierarchy[$qualification->requirement])) {
                        // Both the user's degree and the job's requirement exist in the hierarchy.
                        $userDegreeValue = $degreeHierarchy[$user->degree];
                        $requiredDegreeValue = $degreeHierarchy[$qualification->requirement];

                        // If the user's degree hierarchy value is greater than or equal to the required degree's hierarchy value,
                        // then assign the qualification score.
                        if ($userDegreeValue >= $requiredDegreeValue) {
                            $qualificationScore = $qualification->priority_score;
                        }
                    } else {
                        // Log a warning if either value doesn't exist in the hierarchy.
                        if (!isset($degreeHierarchy[$user->degree])) {
                            Log::warning("Unexpected user degree value: {$user->degree}. Please check the user's degree data.");
                        }
                        if (!isset($degreeHierarchy[$qualification->requirement])) {
                            Log::warning("Unexpected job degree requirement: {$qualification->requirement}. Please check the job's degree requirement data.");
                        }
                    }

                    Log::info("Degree Qualification: Requirement={$qualification->requirement}, User Value={$user->degree}, Score={$qualificationScore}");
                    break;

                // case 'degree':
                //     // Get the hierarchy value for the user's degree and the job's degree requirement.
                //     $userDegreeValue = $degreeHierarchy[$user->degree] ?? 0;
                //     $requiredDegreeValue = $degreeHierarchy[$qualification->requirement] ?? 0;

                //     // If the user's degree hierarchy value is greater than or equal to the required degree's hierarchy value,
                //     // then assign the qualification score.
                //     if ($userDegreeValue >= $requiredDegreeValue) {
                //         $qualificationScore = $qualification->priority_score;
                //     }

                //     Log::info("Degree Qualification: Requirement={$qualification->requirement}, User Value={$user->degree}, Score={$qualificationScore}");
                //     break;

            case 'certifications':
                Log::info("Checking certifications for user id: {$user->id}");
                Log::info("User Certifications (Raw): " . $user->certifications);

                // Trim whitespace from each certification.
                $userCertifications = array_map('trim', explode(',', $user->certifications));

                Log::info("User Certifications (Trimmed Array): " . json_encode($userCertifications));
                Log::info("Qualification Requirement: " . $qualification->requirement);
                Log::info("Qualification Priority Score: " . $qualification->priority_score);

                if (in_array($qualification->requirement, $userCertifications)) {
                    Log::info("Match found! Adding {$qualification->priority_score} to score.");
                    $qualificationScore = $qualification->priority_score;
                } else {
                    Log::info("No match found.");
                }
                break;

            case 'eligibility':
                if ($user->eligibility == $qualification->requirement) {
                    $qualificationScore = $qualification->priority_score;
                }
                Log::info("Eligibility Qualification: Requirement={$qualification->requirement}, User Value={$user->eligibility}, Score={$qualificationScore}");
                break;
        }

        $score += $qualificationScore; // Add the qualification score to the total score.
    }

    Log::info("Total Score for User ID {$user->id}: {$score}");

    return $score;
}

private function convertExperienceToMonths($experience) {
    $yearsToMonths = 0;
    $months = 0;

    // Parse years.
    if (preg_match('/(\d+)\s*year/', $experience, $matches)) {
        $yearsToMonths = (int)$matches[1] * 12;
    }

    // Parse months.
    if (preg_match('/(\d+)\s*month/', $experience, $matches)) {
        $months = (int)$matches[1];
    }

    return $yearsToMonths + $months;
}


public function generatePDF($jobId)
{

    set_time_limit(300); // Increase the maximum execution time to 300 seconds for this method
    ini_set('memory_limit', '256M');

    $job = Job::findOrFail($jobId);
    $sortedApplicants = JobApplication::where('job_id', $jobId)
                        ->with('user') // eager load user data
                        ->orderBy('matching_score', 'desc') // order by matching score
                        ->get();

    // Convert the image to Base64
    $imagePath = public_path('assets/img/gsc.png');
    $type = pathinfo($imagePath, PATHINFO_EXTENSION);
    $data = file_get_contents($imagePath);
    $base64Image = 'data:image/' . $type . ';base64,' . base64_encode($data);

    // Set options for dompdf
    $pdf = PDF::setOption('isRemoteEnabled', true)
              ->setOption('debugKeepTemp', true)
              ->setOption('isHtml5ParserEnabled', true)
              ->loadView('pdf.applicants', ['job' => $job, 'sortedApplicants' => $sortedApplicants, 'base64Image' => $base64Image]);

    return $pdf->download('applicants_report.pdf');
}








    // public function handleResume(Request $request, Job $job)
    // {

    // // Ensure the user is authenticated before proceeding
    // if (!Auth::check()) {
    //     return redirect()->route('login')->with('error', 'You need to be logged in to apply for a job.');
    // }

    // // Validate the uploaded CV
    // $request->validate([
    //     'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
    // ]);

    // // try {
    //     // Store the CV
    //     $cvPath = $request->file('cv')->store('cvs');

    //     // Create the job application record in the database
    //     $job->applications()->create([
    //         'user_id' => Auth::id(),
    //         'cv_path' => $cvPath,
    //     ]);

    //     return redirect()->route('jobs.show', $job->id)
    //         ->with('success', 'Application submitted successfully!');
    // // } catch (\Exception $e) {
    // //     Log::error("Error while applying for job: " . $e->getMessage());
    // //     return redirect()->back()->with('error', 'There was an issue with your application. Please try again.');
    // // }
    // }




}
