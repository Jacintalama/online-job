<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class HiringController extends Controller
{
    public function getQualifiedApplicants(Job $job)
    {
        $thresholdScore = 0.7 * $job->max_score;  // Define the threshold as 70% of max_score
        // $thresholdScore = ($thresholdPercentage / 100) * $job->max_score;

        // Retrieve all applicants who have a score greater than or equal to the threshold
        $qualifiedApplicants = $job->applications()->where('matching_score', '>=', $thresholdScore)->get();

        return $qualifiedApplicants;
    }
    public function rankApplicants($qualifiedApplicants)
    {
        // Order the applicants by their score in descending order
        $rankedApplicants = $qualifiedApplicants->sortByDesc('matching_score');

    return $rankedApplicants;
    }
    public function makeHiringDecision($rankedApplicants, $positionsAvailable)
    {
    // Select the top N applicants, where N is the number of positions available
         $hiredApplicants = $rankedApplicants->take($positionsAvailable);

    // Update the status of the hired applicants in the database
        foreach ($hiredApplicants as $applicant) {
            $applicant->update(['status' => 'hired']);
        }

    return $hiredApplicants;
    }
    public function processHiring(Job $job)
    {
        // Step 3: Determine Qualified Applicants
        $qualifiedApplicants = $this->getQualifiedApplicants($job);

        // Step 4: Rank Applicants
        $rankedApplicants = $this->rankApplicants($qualifiedApplicants);

        // Step 5: Hiring Decision
        $positionsAvailable = $job->positions_available;  // Assume this attribute exists on the Job model
        $hiredApplicants = $this->makeHiringDecision($rankedApplicants, $positionsAvailable);

        // Other logic (sending emails, etc.)

    return response()->json(['message' => 'Hiring process completed', 'hired' => $hiredApplicants]);
    }
    // In HiringController

    public function showHiringResults(Job $job)
    {
        $qualifiedApplicants = $this->getQualifiedApplicants($job);
        $rankedApplicants = $this->rankApplicants($qualifiedApplicants);
        $hiringDecision = $this->makeHiringDecision($rankedApplicants, $job->positions_available);

    return view('departmenthead.hiring_results', compact('job', 'hiringDecision'));
    }





}
