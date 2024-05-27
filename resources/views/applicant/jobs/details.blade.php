<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot><br><br>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>{{ $job->position_title }}</h3>
            </div>
            <div class="card-body">
                <h5><strong>Department: {{ $job->department->name }}</strong></h5><br>

                <p>
                    <i class="fas fa-briefcase"></i> <!-- Font Awesome briefcase icon -->
                    <strong>Egibility:</strong>
                    @if($job->eligibilities->isNotEmpty())
                        {{ $job->eligibilities->pluck('name')->implode('  ') }}
                    @else
                        N/A
                    @endif
                </p><br>
                <p>
                    <i class="fas fa-briefcase"></i> <!-- Font Awesome briefcase icon -->
                    <strong>Job Type:</strong>
                    @if($job->jobTypes->isNotEmpty())
                        {{ $job->jobTypes->pluck('name')->implode(', ') }}
                    @else
                        N/A
                    @endif
                </p>

                <p>
                    <i class="fas fa-clock"></i> <!-- Font Awesome clock icon -->
                    <strong>Schedule:</strong>
                    @if($job->jobSchedules->isNotEmpty())
                        {{ $job->jobSchedules->pluck('name')->implode(', ') }}
                    @else
                        N/A
                    @endif
                </p><br>

                <hr>
                <p><strong>Monthly Salary:</strong> ₱{{$job->monthly_salary}}</p><br>
                <p><strong> Competency:</strong> {!! $job->competency !!}</p><br>
                <p><strong>Qualifications:</strong></p>
                <ul>
                    @foreach($job->qualifications->filter(function($qualification) {
                        return $qualification->type !== 'eligibility';
                    }) as $qualification)
                        <li>{{ $qualification->type }}: {{ $qualification->requirement }}</li>
                    @endforeach
                </ul><br>

                <p><strong>Training:</strong> {!! $job->training!!}</p><br><br>
                {{-- <p><strong>Number of Applicants to Hire:</strong> {{ $job->number_of_applicants_to_hire }}</p> --}}
                <p><strong>Gender Requirement:</strong> {{$job->gender_requirement}}</p>
                <p><strong>Contact Email:</strong>📧 {{ $job->contact_email }}</p><br>
                <p><strong>Contact Phone:</strong>📞 {{ $job->contact_phone }}</p><br><hr><br>
                <p><strong>Application Deadline:</strong> {{ $job->job_deadline }}</p>
                <p><strong>Start for Job:</strong> {{ $job->start_date_job}}</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($hasApplied)
            <div class="alert alert-info mt-4">
                <p>You have already applied for this job.</p>
            </div>
            {{-- @elseif($job->number_of_applicants_to_hire <= $currentApplicationsCount)
            <div class="alert alert-info mt-4">
                <p>Sorry, this position has been meet the maximum applicants.</p>
            </div> --}}
        @else
           <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h4>Apply for this job</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('apply.for.job', $job->id) }}">
                @csrf
                <!-- Hidden input for job ID -->
                <input type="hidden" name="job_id" value="{{ $job->id }}">

                <div class="relative bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <div class="absolute inset-y-0 left-0 flex items-center ml-4">
                        <!-- Triangle with Exclamation Mark Icon: SVG -->
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11.496 2.136c.39-.547.335-1.279-.128-1.708C11.205.253 10.651.221 10.261.768L1.232 13.799c-.39.547-.335 1.279.128 1.708.196.219.45.331.705.331.199 0 .398-.074.56-.203l8.954-6.272c.39-.273.438-.806.106-1.185l-2.699-3.083 2.13-2.979zm-6.8 10.7L9.399 8.47l1.951 2.226-2.28 3.19a1.147 1.147 0 00-.174-.055zm1.615-1.676a.802.802 0 00-.185.228.745.745 0 00-.11-.024zm-.631.742l-.196-.076 2.094-2.943.215.157-2.113 2.862zm2.703-3.547c-.196-.219-.45-.331-.705-.331a.869.869 0 00-.294.057L4.116 12.14l2.134-2.991 2.549-1.785zM5.172 12.66l-.203.12.203.283.203-.283-.203-.12zm-1.098 1.531a.815.815 0 00-.03.243c0 .106.019.21.056.307a.802.802 0 00.155.221l-.211.15zm-.261.696l-.203-.12-.106.177a1.14 1.14 0 00.309.156zm-.338.329c.075.015.151.024.229.024a.869.869 0 00.294-.057l.211.15-.203.283a.802.802 0 00-.532-.4zm1.615.924l.215.157-.215-.283-.215.283.215-.157zm1.676-10.46a.745.745 0 00.11.024L7.33 5.45l-.204-.283-.204.283.203-.12zm-.024.394c.03-.08.067-.155.11-.228.043.073.08.148.11.228l.203.283-.203-.12-.21-.171zm.436.608l.215.157-.215-.283-.215.283.215-.157zm.843 1.18L8.715 8.47l-.203-.283-.204.283.204-.12zm-1.301 1.46c.02-.066.043-.132.072-.195a.745.745 0 00.185-.228l.204-.283-.204.12-.257.586zm.785 1.103L9.4 11.695l-.204.283.204-.12zm-.817 1.147c.02-.066.043-.132.072-.195a.745.745 0 00.185-.228l.204-.283-.204.12-.257.586zm-.072.394c.015-.051.033-.101.055-.15a.745.745 0 00.11-.024l.203-.283-.203.12-.165.337zm-.11.228c.015-.051.033-.101.055-.15a.745.745 0 00.11-.024l.203-.283-.203.12-.165.337zm-.11.228c.015-.051.033-.101.055-.15a.745.745 0 00.11-.024l.203-.283-.203.12-.165.337zm.024.394c.015-.051.033-.101.055-.15a.745.745 0 00.11-.024l.203-.283-.203.12-.165.337zm.072.394c.015-.051.033-.101.055-.15a.745.745 0 00.11-.024l.203-.283-.203.12-.165.337z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="pl-8">
                        Ensure to edit your profile, as well as your information and the resume, before applying for this job, Once you click it there is no second chance for apply again so be aware of it !
                    </p>
                </div><br>


                <x-button class="py-4 px-8 text-2xl" type="submit">Apply</x-button>



            </form>

        </div>
    </div>
        @endif


    </div>
</x-app-layout>
