<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Edit Job
        </h2>
    </x-slot>

    <!-- Edit Job Form -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Edit Job
            </div>
            <div class="card-body">
                <form action="{{ route('departmenthead.jobs.update', $job->id) }}" method="POST">
                    @csrf

                    <!-- Position Title -->
<div class="mb-4">
    <label for="position_title" class="block text-sm font-medium text-gray-700">Position Title</label>
    <input type="text" name="position_title" id="position_title" value="{{ old('position_title', $job->position_title) }}" class="mt-1 p-2 w-full border rounded-md">
</div>

<!-- Department -->
<div class="mb-4">
    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
    <select name="department_id" id="department" class="mt-1 p-2 w-full border rounded-md">
        @foreach($departments as $department)
        <option value="{{ $department->id }}" {{ optional($job->department)->id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>

        @endforeach
    </select>
</div>
{{-- <!-- Number of Applicants to Hire -->
<div class="form-group">
    <x-label for="number_of_applicants_to_hire" value="{{ __('Number of Applicants to Hire') }}" />
    <x-input id="number_of_applicants_to_hire" type="number" name="number_of_applicants_to_hire" value="{{ $job->number_of_applicants_to_hire }}" required />
</div><br> --}}


<!-- Eligibility -->
<div class="mb-4">
    <label for="eligibility" class="block text-sm font-medium text-gray-700">Eligibility</label>
    <!-- Single select dropdown for eligibilities -->
    <select name="eligibility" id="eligibility" class="mt-1 p-2 w-full border rounded-md">
        @foreach($eligibilities as $eligibility)
        <option value="{{ $eligibility->id }}" {{ ($job->eligibilities->contains('id', $eligibility->id)) ? 'selected' : '' }}>{{ $eligibility->name }}</option>


        @endforeach
    </select>

</div>



{{-- {{ dd($qualificationData) }} --}}

{{-- QUALIFICATION --}}
<label for="department" class="block text-sm font-medium text-gray-700">Qualification</label>
@foreach($qualificationData as $qualification)
<div class="p-4 border rounded-md mb-4">
    <div class="flex items-center mb-2">
        <label class="w-1/4 font-semibold">Type:</label>
        <select name="qualifications[type][]" class="w-3/4 border p-2 rounded">
            <option value="experience" {{ $qualification['type'] == 'experience' ? 'selected' : '' }}>Experience</option>
            <option value="degree" {{ $qualification['type'] == 'degree' ? 'selected' : '' }}>Degree</option>
            <option value="certifications" {{ $qualification['type'] == 'certifications' ? 'selected' : '' }}>Certifications</option>
            <option value="eligibility" {{ $qualification['type'] == 'eligibility' ? 'selected' : '' }}>Eligibility</option>
        </select>
    </div>

    <div class="flex items-center mb-2">
        <label class="w-1/4 font-semibold">Requirement:</label>
        <input type="text" name="qualifications[requirement][]" value="{{ $qualification['requirement'] }}" class="w-3/4 border p-2 rounded">
    </div>

    <div class="flex items-center">
        <label class="w-1/4 font-semibold">Priority Score:</label>
        <input type="number" name="qualifications[priorityScore][]" value="{{ $qualification['priorityScore'] }}" class="w-3/4 border p-2 rounded">
    </div>
</div>
@endforeach<br>




<!-- Job Type -->
<br><div class="form-group">
    <label><strong>Type of Employment:</strong></label>
    <div class="mt-2">
        <label><strong>Job Type</strong></label>
        @foreach($jobTypes as $type)
        <label>
            <input type="checkbox" name="job_types[]" value="{{ $type->id }}"
                {{ in_array($type->id, $job->jobTypes->pluck('id')->toArray()) ? 'checked' : '' }}>
            {{ $type->name }}
        </label>
        @endforeach
    </div>
</div>
<!-- Job Schedule -->
<div class="form-group">
    <label><strong>Job Schedule:</strong></label>
    @foreach($jobSchedules as $schedule)
    <label>
        <input type="checkbox" name="job_schedules[]" value="{{ $schedule->id }}"
            {{ in_array($schedule->id, $job->jobSchedules->pluck('id')->toArray()) ? 'checked' : '' }}>
        {{ $schedule->name }}
    </label>
    @endforeach
</div><br>

<div class="form-group mb-4">
    <label for="salary_grade" class="block mb-2"><strong>Salary Grade:</strong></label>
    <select name="salary_grade" id="salary_grade" class="border p-3 rounded" required onchange="updateMonthlySalary()">
        <option value="">Select Salary Grade</option>
        @foreach ($salaryGrades as $grade)
            <option value="{{ $grade->grade }}" {{ $job->salary_grade == $grade->grade ? 'selected' : '' }}>{{ $grade->grade }}</option>
        @endforeach
    </select>
</div>

<div class="form-group mb-4">
    <label class="block mb-2"><strong>Monthly Salary:</strong></label>
    <input type="text" id="monthly_salary" readonly class="border p-2 rounded" value="{{ $job->monthly_salary }}" placeholder="Monthly Salary will display here" />
    <!-- Hidden input to store the numeric salary value for submission -->
    <input type="hidden" id="monthly_salary_numeric" name="monthly_salary" value="{{ $job->monthly_salary }}" />
</div>


<!-- Competency -->
<div class="mb-4">
    <label for="competency" class="block text-sm font-medium text-gray-700">Competency</label>
    <textarea name="competency" id="competency" class="mt-1 p-2 w-full border rounded-md">{{ $job->competency }}</textarea>
</div>

<!-- Trainings -->
<div class="mb-4">
    <label for="training" class="block text-sm font-medium text-gray-700">Trainings</label>
    <textarea name="training" id="training" class="mt-1 p-2 w-full border rounded-md">{{ $job->training }}</textarea>
</div>

                    <x-button class="mt-4" type="submit">Update Job</x-button>
                </form>
            </div>
        </div>
    </div>


    <script>
        var salaryData = @json($salaryGrades->pluck('amount', 'grade'));

        function updateMonthlySalary() {
            var grade = document.getElementById('salary_grade').value;
            var monthlySalaryDisplayInput = document.getElementById('monthly_salary'); // For display purposes
            var monthlySalaryInput = document.getElementById('monthly_salary_numeric'); // For submission

            // Retrieve the salary from the salaryData object
            var salary = salaryData[grade];

            // Update the display input with the formatted currency string
            monthlySalaryDisplayInput.value = salary ? '₱ ' + Number(salary).toLocaleString() : 'Select a valid grade';

            // Update the hidden input with a numeric value for submission
            monthlySalaryInput.value = salary || ''; // Store the numeric value only
        }
    </script>
</x-app-layout>
