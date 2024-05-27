<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Applied Job') }}
        </h2>
    </x-slot><br><br>

<style>
        /* Style for the table */
        table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border-radius: 10px;
    }

         /* Style for the table headers */
    table thead th {
        background-color: #505050; /* Dark grey header background */
        color: #181717; /* White text */
        padding: 10px;
        text-align: left;
    }

        /* Style for the table body rows */
        table tbody tr {
        transition: background-color 0.3s ease, transform 0.3s ease; /* Combined transitions */
    }

        tbody tr:hover {
        background-color: #7ec0f7;
        transform: scale(1.01); /* Slightly enlarge the row on hover */
        transition: transform 0.3s ease, background-color 0.3s ease;
    }
    td {
        position: relative;
    }td::after { /* Add shadow on the right of each cell */
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 2px;
        height: 100%;
        background-color: #ddd;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

        /* Style for the table body data cells */
        table tbody td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0; /* Light grey border between rows */
        }

        table tbody tr:last-child td {
            border-bottom: none; /* Remove border for the last row */
        }
         /* Style for card */

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


                <!-- Main Content Section -->
                <div class="col-lg-9 col-md-12">
                    <div class="table-responsive card23">
                        <table class="table table-bordered">
                            <!-- Table Header -->
                            <thead>
                                <tr>

                                    <th>Position Title</th>
                                    <th>Department</th>
                                    <th>Date of Applied</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                @foreach($appliedJobs as $application)
                                    <tr>

                                        <td>{{ $application->job ? $application->job->position_title : 'Job not found' }}</td>
                                        <td>{{ $application->job ? $application->job->department->name : 'N/A' }}</td>
                                        <td>{{ $application->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($application->applicantRecords)
                                                @switch($application->applicantRecords->status)
                                                    @case('hired')
                                                        <span class="bg-green-200 text-green-800 px-2 py-1 rounded-full">
                                                            Hired
                                                        </span>
                                                        @break
                                                    @case('not_hired')
                                                        <span class="bg-red-200 text-red-800 px-2 py-1 rounded-full">
                                                            Rejected
                                                        </span>
                                                        @break
                                                    @default
                                                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">
                                                            Pending
                                                        </span>
                                                @endswitch
                                            @else
                                                <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
