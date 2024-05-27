<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BookmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }

    public function store(Request $request, $jobId)
    {
        // Logic to bookmark a job
        $bookmark = new Bookmark;
        $bookmark->user_id = Auth::id();
        $bookmark->job_id = $jobId;
        $bookmark->save();

        return redirect()->back()->with('success', 'Job bookmarked successfully.');
    }

    public function destroy($id)
    {
        // Logic to unbookmark a job
        $bookmark = Bookmark::find($id);
        $bookmark->delete();

        return redirect()->back()->with('success', 'Job unbookmarked successfully.');
    }

    public function toggleBookmark(Job $job)
    {
    $bookmark = auth()->user()->bookmarks()->where('job_id', $job->id)->first();

    if ($bookmark) {
        // If a bookmark exists, delete it
        $bookmark->delete();
    } else {
        // If no bookmark exists, create it
        auth()->user()->bookmarks()->create(['job_id' => $job->id]);
    }

    return redirect()->back();
    }

}
