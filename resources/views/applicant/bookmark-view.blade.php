<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookmark') }}
        </h2>
    </x-slot><br><br>
<style>
        @keyframes riseUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-rise {
            animation: riseUp 0.5s ease-out;
        }
</style>

    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
                <!-- Sidebar Section -->
                <div class="col-lg-3 col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <strong>Navigation</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item {{ Request::is('applicant/dashboard') ? 'bg-light' : '' }}">
                                <a href="{{ route('applicant.dashboard') }}" class="{{ Request::is('applicant/dashboard') ? 'text-primary font-weight-bold' : '' }}">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="list-group-item {{ Request::is('applicant/applications') ? 'bg-light' : '' }}">
                                <a href="{{ route('applicant_applications') }}" class="{{ Request::is('applicant/applications') ? 'text-primary font-weight-bold' : '' }}">
                                    <i class="fas fa-briefcase mr-2"></i> Applied Jobs
                                </a>
                            </li>
                            <li class="list-group-item {{ Request::is('applicant/bookmark-view') ? 'bg-light' : '' }}">
                                <a href="{{ route('applicant.bookmark-view') }}" class="{{ Request::is('applicant/bookmark-view') ? 'text-primary font-weight-bold' : '' }}">
                                    <i class="fas fa-bookmark mr-2"></i> Bookmarked Jobs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="container mx-auto p-6">
                        <h1 class="text-center text-gray-700 mb-6">Bookmarked Jobs</h1>

                        @forelse($bookmarkedJobs as $job)
                            <div class="job-card bg-white p-6 mb-6 border rounded shadow-md animate-rise">
                                <h2 class="text-gray-800 text-lg font-semibold mb-2">{{ $job->position_title }}</h2>
                                <p class="text-gray-600 mb-2"><strong>Department:</strong> {{ $job->department->name }}</p>
                                <p class="text-gray-600 mb-2">{{ Str::limit($job->description, 100, '...') }}</p>
                                <a href="{{ route('jobs.details', $job) }}" class="job-details-link text-white bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Job Details</a>
                            </div>
                        @empty
                            <p class="no-jobs text-center text-gray-500 italic">You have no bookmarked jobs.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
