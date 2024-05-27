<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Applicants for {{ $job->position_title }}
        </h2>
    </x-slot>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<style>
    .page-heading {
        background-color: #f8f9fa; /* Light gray background, you can change the color */
        padding: 1rem 0; /* Spacing above and below the text */
        margin-bottom: 2rem; /* Additional spacing below the header */
        border-bottom: 1px solid #e3e6f0; /* A subtle bottom border */
        color: #4a4e69; /* Dark text color for contrast */
    }
</style>
<div class="d-flex justify-content-center align-items-start mt-5" style="height: 100vh;">
    <div class="bg-light p-4 rounded shadow-sm col-md-6 overflow-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            @if (!$job->is_closed)
            <form action="{{ route('close.job', $job->id) }}" method="POST">
                @csrf
                <form action="{{ route('close.job', $job->id) }}" method="POST" onsubmit="return confirmCloseJob();">
                    @csrf
                    <x-button type="submit" class="btn btn-danger me-2">
                        <i class="fas fa-times-circle"></i> Close Job
                    </x-button>
                </form>
            </form>
        @else
            {{-- If the job is closed, show a disabled button or a label --}}
            <x-button class="btn btn-secondary me-2" disabled>
                <i class="fas fa-check-circle"></i> Job Closed
            </x-button>
        @endif
            <div class="d-flex justify-content-end"> <!-- This ensures that the buttons are on the right -->
                <!-- Existing buttons here -->
                <x-button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#messageModal">
                    <i class="fas fa-envelope"></i>
                </x-button>
                <x-button class="btn btn-primary">
                    <a href="{{ route('generate.pdf', $job->id) }}" class="text-white text-decoration-none">
                        <i class="fas fa-file-pdf"></i> Download Report
                    </a>
                </x-button>
            </div>

        </div>




        {{-- <div class="page-heading">
            <h2 class="text-center mb-0">Applicants for {{ $job->position_title }}</h2>
        </div> --}}
        <div class="mb-3">
            <strong>Total of applicants: {{ $sortedApplicants->count() }}</strong>
        </div>
        <div class="mb-3">
            <strong>The total threshold for this job is: {{ number_format(0.7 * $job->max_score, 2) }}</strong>
        </div>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Matching Score</th> <!-- Add this header -->
                    <th>Remarks</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sortedApplicants as $applicant)
                <tr id="applicant-row-{{ $applicant->user->id }}">
                    <td>
                        <a href="{{ route('profile.export', $applicant->user->id) }}">
                            {{ $applicant->user->first_name }}
                            {{ $applicant->user->middle_initial }}.
                            {{ $applicant->user->last_name }}
                        </a>
                    </td>

                    <td>{{ $applicant->matching_score }}%</td>

                    <!-- Remarks Column -->
                    <td class="remarks">
                        @if($applicant->user->hasBeenHired()) <!-- Check if the applicant has been hired -->
                            This applicant has already been hired.
                        @else
                            <x-button class="btn btn-success" onclick="updateStatus({{ $applicant->user->id }}, {{ $job->id }}, 'hired')"><i class="fas fa-check"></i>
                                Hire</x-button>
                            <x-button class="btn btn-danger btn-reject btn-sm" onclick="updateStatus({{ $applicant->user->id }}, {{ $job->id }}, 'not_hired')"> <i class="fas fa-times"></i>Reject</x-button>
                        @endif
                    </td>

                    <td>
                        <!-- If you have implemented file upload functionality,
                             you might enable employers to download the applicant’s CV.
                             Otherwise, you might display relevant information from the user’s profile. -->
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </div>
</div>
{{-- Modal for sending message --}}
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Message to Applicants</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('message.applicants') }}" method="post">
                @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <div class="modal-body">
                    <textarea
                        name="content"
                        class="form-control @error('content') is-invalid @enderror"
                        placeholder="Type your message..."
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <hr>
                    <label>Select Applicants:</label>
                    <input type="checkbox" id="selectAll"> Select All <br>
                    <select
                        name="applicants[]"
                        class="form-control @error('applicants') is-invalid @enderror"
                        multiple
                    >
                    @foreach($sortedApplicants as $applicant)
                            <option
                                value="{{ $applicant->user->id }}"
                                {{ in_array($applicant->user->id, old('applicants', [])) ? 'selected' : '' }}
                            >{{ $applicant->user->name }}</option>
                        @endforeach
                    </select>
                    @error('applicants')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small class="text-muted">Hold Ctrl or Cmd to select multiple applicants.</small>
                </div>
                <div class="modal-footer">
                    <x-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</x-button>
                    <x-button type="submit" class="btn btn-primary">Send</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Functionality to select all options
    $(document).ready(function() {
        $('#selectAll').click(function() {
            $('select[name="applicants[]"] option').prop('selected', $(this).prop('checked'));
        });
    });

    // Functionality to handle download link
    document.getElementById('downloadLink').addEventListener('click', function (e) {
        e.preventDefault();
        var link = document.createElement('a');
        link.href = this.href;
        link.download = 'filename_here';  // Optional: Set a filename
        link.click();
    });


  // Function to update the applicant status
  function updateStatus(applicantId, jobId, status) {
    fetch(`/update-applicant-status/${applicantId}/${jobId}/${status}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Get the row corresponding to the applicant
            const applicantRow = document.getElementById(`applicant-row-${applicantId}`);

            // Find the remarks column in the row
            const remarksColumn = applicantRow.querySelector('td:nth-child(3)'); // Assuming the remarks column is the third column

            if (status === 'hired') {
                remarksColumn.textContent = 'This applicant has already been hired.';
            } else if (status === 'not_hired') {
                remarksColumn.textContent = 'This applicant has been rejected.';
            }

        } else {
            alert('Error updating status.');
        }
    })
    .catch(error => {
        console.error('Error occurred:', error);
        alert('An error occurred. Please try again.');
    });

}


</script>
<script>
     function confirmCloseJob() {
        return confirm('Are you sure you want to close this job?');
    }
</script>
</x-app-layout>
