<?php

namespace App\Http\Controllers;

use App\Models\Eligibility;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Qualification;
use App\Models\SalaryGrade;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\JobType;
use App\Models\JobSchedule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobs = Job::all();
        $departments = Department::all(); // You might not need to retrieve all departments if department heads can't choose.
        $jobTypes = JobType::all();
        $jobSchedules = JobSchedule::all();
        $eligibilities = Eligibility::all();
        $salaryGrades = SalaryGrade::all(); // Retrieve all salary grades

        // Assuming you're using Laravel's default authentication and your department heads have a department_id field
        $departmentHead = Auth::user();
        $assignedDepartment = $departmentHead->department; // Get the assigned department of the department head

        // Now pass the assigned department along with other data to the view
        return view('departmenthead.post-job', compact('jobs', 'jobTypes', 'jobSchedules', 'departments', 'eligibilities', 'salaryGrades', 'assignedDepartment'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Dump and die
        Log::info('Form data:', $request->all());
        Log::info('Request data:', $request->all());
        Log::info("Store method reached.");
        $validatedData = $request->validate([

            'position_title' => 'required|string|max:255',
            'competency' => 'required|string',
            'qualifications.type.*' => 'required|string|in:experience,degree,certifications,eligibility',
            'qualifications.requirement.*' => 'required|string',
            'qualifications.priorityScore.*' => 'required|integer|min:1',
            'training' => 'nullable|string',
            'eligibility.*' => 'nullable|exists:eligibilities,id',

            // 'number_of_applicants_to_hire' => 'required|integer',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'has_start_date' => 'required|in:yes,no',

            'job_deadline' => 'required|date',

            'monthly_salary' => 'required|numeric|min:0',
            'salary_grade' => 'required|integer|between:1,33', // the salary grade exists in the `salary_grades` table and is within the valid range
            'gender_requirement' => 'required|string|in:male,female,male/female',
            'department_id' => 'required|exists:departments,id', // Ensure the provided department ID exists
            'job_types' => 'required|array',
            'job_schedules' => 'required|array',
            'job_types.*' => 'exists:job_types,id',
            'job_schedules.*' => 'required|exists:job_schedules,id',
            'start_date_job' => Rule::requiredIf(function () use ($request) {
                return $request->input('has_start_date') === 'yes';
            })
        ]);

 // Create a new Job with the validated data
 $job = new Job($validatedData);

 // Set additional properties on the job
 $job->department_head_id = Auth::id();
 $job->monthly_salary = $validatedData['monthly_salary'];

 // Save the Job to generate an ID
 $job->save();

 // Attach the job types and schedules
 $job->jobTypes()->sync($request->input('job_types'));
 $job->jobSchedules()->sync($request->input('job_schedules'));

 // Add qualifications
 foreach ($request->input('qualifications.type') as $index => $type) {
     $requirement = $request->input('qualifications.requirement')[$index];
     $priorityScore = $request->input('qualifications.priorityScore')[$index];

     $job->qualifications()->create([
         'type' => $type,
         'requirement' => $requirement,
         'priority_score' => $priorityScore,
     ]);
 }

 // Attach eligibility
 $eligibilityId = $request->input('eligibility');
 $job->eligibilities()->attach($eligibilityId);

 // Redirect with success message
 return redirect()->route('departmenthead.dashboard')->with('success', 'Job posted successfully.');
}

    /**
     * Display the specified resource.
     */

    public function show(Job $job)
    {

       // Check if the user has already applied for this job
       $hasApplied = $job->applications()->where('user_id', Auth::id())->exists();
    // Calculate the number of hired applicants
       $currentHiredCount = JobApplication::where('job_id', $job->id)->where('status', 'hired')->count();



       // Return the view with the job details and the hasApplied flag
       return view('applicant.jobs.details', compact('job', 'hasApplied', 'currentHiredCount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return $this->getEditView($job);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
{
        // dd($request->all());
        $job->fill($request->all());
        // dd($job->getAttributes());
        $job->save();
        // dd($job);
        $job->position_title = $request->position_title;
        $job->department_id = $request->department_id;

        $job->eligibility = $request->eligibility;

        $job->save();
        // If qualifications are provided, handle them
      if($request->has('qualifications')) {
        $qualifications = $request->input('qualifications');

        // First, delete all existing qualifications for this job
        $job->qualifications()->delete();

        // Now, add the new qualifications
        foreach ($qualifications['type'] as $index => $type) {
            $requirement = $qualifications['requirement'][$index];
            $priorityScore = $qualifications['priorityScore'][$index];

            // Create a new qualification
            $qualification = new Qualification([
                'type' => $type,
                'requirement' => $requirement,
                'priority_score' => $priorityScore
            ]);

            $job->qualifications()->save($qualification);
        }
    }
    $job->jobTypes()->sync($request->input('job_types'));
    $job->jobSchedules()->sync($request->input('job_schedules'));

    $job->eligibilities()->sync([$request->input('eligibility')]);
    $job->save();
    $validatedData = $request->validate([
        'position_title' => 'required|string|max:255',
        'competency' => 'required|string',
        'qualifications.type.*' => 'required|string|in:experience,degree,certifications,eligibility',
        'qualifications.requirement.*' => 'required|string',
        'qualifications.priorityScore.*' => 'required|integer|min:1',
        'training' => 'nullable|string',
        'eligibility.*' => 'nullable|exists:eligibilities,id',

        'contact_email' => 'required|email|max:255',
        'contact_phone' => 'required|string|max:20',
        'has_start_date' => 'required|in:yes,no',
        'job_deadline' => 'required|date',

        'monthly_salary' => 'required|numeric|min:0',
        'salary_grade' => 'required|integer|between:1,33',
        'gender_requirement' => 'required|string|in:male,female,male/female',
        'department_id' => 'required|exists:departments,id',
        'job_types' => 'required|array',
        'job_schedules' => 'required|array',
        'job_types.*' => 'exists:job_types,id',
        'job_schedules.*' => 'required|exists:job_schedules,id',
        'start_date_job' => Rule::requiredIf(function () use ($request) {
            return $request->input('has_start_date') === 'yes';
        })
    ]);

      // Update main job details
      $job->update($validatedData);



          // Handle job types, schedules, and eligibilities as you did in the store method

    $job->jobTypes()->sync($request->input('job_types'));
    $job->jobSchedules()->sync($request->input('job_schedules'));
    // $eligibilityId = $request->input('eligibility');
    $job->eligibilities()->sync($request->input('eligibility'));
    $job->save();


      // Redirect back to the edit page with a success message
      return $this->getEditView($job)->with('success', 'Job updated successfully.');
  }
  private function getEditView(Job $job)
  {
      $user = auth()->user();
      $jobTypes = JobType::all();
      $jobSchedules = JobSchedule::all();
      $departments = Department::all();
      $eligibilities = Eligibility::all();
      $salaryGrades = SalaryGrade::all(); // Retrieve all salary grades

      $qualificationData = $job->qualifications->map(function ($qualification) {
          return [
              'type' => $qualification->type,
              'requirement' => $qualification->requirement,
              'priorityScore' => $qualification->priority_score,
          ];
      })->all();

      if ($user->role === 'admin') {
          return view('admin.jobs.edit', compact('job', 'jobTypes', 'jobSchedules', 'departments', 'eligibilities', 'qualificationData', 'salaryGrades'));
      } elseif ($user->role === 'department_head') {
          return view('departmenthead.jobs.edit', compact('job', 'jobTypes', 'jobSchedules', 'departments', 'eligibilities', 'qualificationData', 'salaryGrades'));
      } else {
          return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
      }
  }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('departmenthead.dashboard')->with('success', 'Job deleted successfully.');
    }

    public function reject(Request $request, Job $job)
    {
    Log::info('Before Update:', ['status' => $job->status]);

    $job->update(['status' => 'rejected']);

    Log::info('After Update:', ['status' => $job->status]);

    return redirect()->back()->with('danger', 'Job rejected.');
    }


    public function publish(Job $job)
    {
    // Check if the job is already published
    if($job->status === 'published') {
        return redirect()->back()->with('warning', 'The job is already published.');
    }

    // Update the job status to published
    $job->update(['status' => 'published']);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Job published successfully.');
    }


    public function unpublish(Job $job)
    {
    // Check if the job is already unpublished
    if($job->status === 'unpublished') {
        return redirect()->back()->with('warning', 'The job is already unpublished.');
    }

    // Update the job status to unpublished
    $job->update(['status' => 'unpublished']);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Job unpublished successfully.');
    }


    public function details(Job $job)
    {

        if($job->job_deadline < now()) {
            return redirect()->back()->withErrors(['error' => 'Sorry, the application period for this job has ended.']);
        }


        Log::info('Accessing job details for job id: ' . $job->id);
        $hasApplied = $job->applications()->where('user_id', Auth::id())->exists();
        $currentApplicationsCount = JobApplication::where('job_id', $job->id)->count();




        return view('applicant.jobs.details', compact('job', 'hasApplied', 'currentApplicationsCount'));
    }


    public function searchJobs(Request $request)
    {
    // Retrieve search parameters from the request
    $department = $request->input('department');
    $position_titleOrKeyword = $request->input('position_title');

    // Start the query
    $query = Job::query();

    // Filter by department if provided
    if (!empty($department)) {
        $query->whereHas('department', function ($q) use ($department) {
            $q->where('name', 'LIKE', '%' . $department . '%');
        });
    }

    // Filter by title/keyword if provided
    if (!empty($position_titleOrKeyword)) {
        $query->where('position_title', 'LIKE', '%' . $position_titleOrKeyword . '%');
    }

    // Execute the query and retrieve the results
    $jobs = $query->get();

    // Return the results to the view and redirect to the portfolio section
    return redirect('/#findjobs')->with('jobs', $jobs);
    }

    public function applications()
    {
        $jobs = Job::where('status', 'published')->get();
        $applied_jobs = JobApplication::where('user_id', auth()->id())->get();
        return view('applicant.applications', compact('applied_jobs', 'jobs'));
    }


    public function close($id)
    {
        $job = Job::findOrFail($id);
        $job->is_closed = true;
        $job->save();

        // Redirect back to the previous page with a success message
        return back()->with('status', 'Job closed successfully!');
    }



}
