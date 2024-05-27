<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot><br><br>

    {{-- <div class="container">
        <h2>Published Jobs</h2>

        @foreach($jobs as $job)
            <div class="job-card">
                <h3>{{ $job->position_title }}</h3>
                <p>{{ $job->compentency }}</p>
                <!-- Add other job details here -->
            </div>
        @endforeach
    </div> --}}
    <div class="page-content user-panel">
        <div class="container">
            <div class="row">
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


                    <div class="row box-items">
                        <div class="col-md-4">
                            <div class="box1" style="background-color: #e0f7fa; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);">
                                <h1><strong>Applied Jobs</strong></h1>
                                <h1 class="count">{{ $total_applied_jobs }}</h1>


                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="box2" style="background-color: #e8f5e9; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);">
                                <h1><strong>Hired Job</strong></h1>
                                <h1 class="count">{{ $hired_jobs_count }}</h1>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box3" style="background-color: #fff3e0; box-shadow: 0px 4px 8px rgba(0,0,0,0.1);">
                                <h1><strong>Reject Job</strong></h1>
                                <h1 class="count">{{ $rejected_jobs_count }}</h1>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
