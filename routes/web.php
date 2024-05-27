<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentHeadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Models\Job;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ApplicantMessageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HiringController;






Route::get('/', function () {
    $jobs = Job::where('status', 'published')
               ->where('is_closed', false) // Filter out closed jobs
               ->get();
    return view('welcome', compact('jobs'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin login routes for unauthenticated users

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
// Handle admin login
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');


// SEARCH JOB FUNCTION
Route::get('/searchJobs', [JobController::class, 'searchJobs']);










// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//ADMIN ROUTE
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::post('/jobs/{job}/publish', [JobController::class, 'publish'])->name('jobs.publish');
    Route::post('/jobs/{job}/unpublish', [JobController::class, 'unpublish'])->name('jobs.unpublish');
    Route::post('/jobs/{job}/reject', [JobController::class, 'reject'])->name('jobs.reject');
    Route::get('/manage/users', [AdminController::class, 'manageUsers'])->name('admin.manage.users');
    Route::get('/manage/jobs', [AdminController::class, 'manageJobs'])->name('admin.manage.jobs');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');

    Route::post('/admin/add-departmenthead', [AdminController::class, 'addDEPARTMENTHEAD'])->name('admin.addDEPARTMENTHEAD');
    Route::get('/admin/jobs/{job}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::post('/admin/jobs/{job}', [JobController::class, 'update'])->name('admin.jobs.update');

    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');


    Route::get('admin/manage/reports', [AdminController::class, 'reports'])->name('admin.manage.reports');


    Route::get('/admin/dashboard', function () {
        return view('/admin/dashboard');
    })->name('admin.dashboard');

});


Route::get('/generate-pdf/{jobId}', [JobApplicationController::class, 'generatePDF'])->name('generate.pdf');


Route::get('/user/profile/export/{userId}', [UserProfileController::class, 'export'])->name('profile.export');



Route::get('/download-cv/{filename}', [DepartmentHeadController::class, 'downloadCv'])->name('download.cv');



//Department Head ROUTE
Route::middleware(['auth:sanctum', 'verified', 'role:department_head'])->group(function () {
    Route::get('/departmenthead/dashboard', [DepartmentHeadController::class, 'dashboard'])->name('departmenthead.dashboard');
    Route::get('/post-job', [JobController::class, 'create'])->name('post-job');
    Route::post('/post-job', [JobController::class, 'store'])->name('post-job.store');
    Route::get('/departmenthead/jobs/{job}/edit', [JobController::class, 'edit'])->name('departmenthead.jobs.edit');
    Route::post('/departmenthead/jobs/{job}', [JobController::class, 'update'])->name('departmenthead.jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('departmenthead.jobs.show');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    // Route::get('/download-cv/{application}', [EmployerController::class, 'downloadCv'])->name('download.cv');
    Route::get('/departmenthead/jobs/{job}/applicants', [DepartmentHeadController::class, 'showApplicants'])->name('departmenthead.jobs.applicants');
    Route::get('/job/{job}/qualified-applicants', [HiringController::class, 'getQualifiedApplicants']);
    Route::get('/job/{job}/process-hiring', [HiringController::class, 'processHiring']);
    Route::get('/departmenthead/job/{job}/hiring-results', [HiringController::class, 'showHiringResults'])->name('departmenthead.hiring_results');

    Route::post('/update-applicant-status/{applicantId}/{jobId}/{status}', [DepartmentHeadController::class, 'updateStatus']);
    Route::post('/job/{id}/close', [JobController::class, 'close'])->name('close.job');
    Route::get('/job/{id}/close', [JobController::class, 'close'])->name('close.job');
    Route::post('/job/{id}/close', [JobController::class, 'closeJob'])->name('close.job');
    Route::post('/job/{id}/close', [JobController::class, 'close'])->name('close.job');


});








 // MESSAGE CONTROLLER
 Route::middleware(['auth'])->group(function () {
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/applicant/messages/sent', [ApplicantMessageController::class, 'sent'])->name('applicant.messages.sent');
    Route::resource('messages', MessageController::class);
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::post('/message/applicants', [MessageController::class, 'storeApplicantMessage'])->name('message.applicants');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

});







//APPLICANT ROUTE
Route::middleware(['auth:sanctum', 'verified', 'role:applicant'])->group(function () {
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');

    Route::get('/applicant/applicant_applications', [ApplicantController::class, 'applicant_applications'])->name('applicant_applications');
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/jobs/{job}/details', [JobController::class, 'details'])->name('jobs.details');
    Route::post('/apply-for-job/{job}', [JobApplicationController::class, 'apply'])->name('apply.for.job');
    Route::get('/applicant/applications', [ApplicantController::class, 'applications'])->name('applicant.applications');

    Route::post('/bookmark/{jobId}', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/unbookmark/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get('/job/{job}/bookmark', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle')->middleware('auth');
    Route::get('/applicant/bookmark-view', [ApplicantController::class, 'bookmarkView'])->name('applicant.bookmark-view')->middleware('auth');
    // Route::get('/messages', [ApplicantMessageController::class, 'index'])->name('messages.index');




});




