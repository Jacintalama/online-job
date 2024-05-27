<x-app-layout>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
       Post a Job
    </h2>
</x-slot>
<div class="container mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

        <div class="card-header" id="cardHeader">{{ __('Add Job Basics') }}</div>
        <div class="card-body">
               <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress" id="progress"></div>
                    </div>

        <form method="POST" action="{{ route('post-job.store') }}">

            @csrf
<!-- Step 1: Basic Info -->
<div class="form-step" id="step1">
    <div class="form-group">
        <x-label for="position_title" value="Position Title" />
        <x-input id="position_title" type="text" name="position_title" required class="wide-input" />


    </div>
    {{-- <div class="form-group">
        <x-label for="number_of_applicants_to_hire" value="{{ __('Number of Applicants to Hire') }}" />
        <x-input id="number_of_applicants_to_hire" type="number" name="number_of_applicants_to_hire" required />

    </div> --}}
{{-- Departments --}}
{{-- Department --}}
<div class="form-group">
    <label for="department_id"><strong>Department:</strong></label>
    <input type="text" class="form-control" value="{{ $assignedDepartment->name }}" readonly>
    <input type="hidden" name="department_id" value="{{ $assignedDepartment->id }}">
</div><br>




    <x-button type="button" class="btn" onclick="nextStep(2)">Next</x-button>
</div>

             <!-- Step 2: Job Details -->
    <div class="form-step" id="step2">

                <div class="form-group">
                    <label><strong>Type of Employment:</strong></label>
                    <div class="mt-2">
                        <label><strong>Job Type</strong></label>
                        @foreach($jobTypes as $type)
                        <label>
                            <input type="checkbox" name="job_types[]" value="{{ $type->id }}">
                            {{ $type->name }}
                        </label>
                        @endforeach
                    </div>
                </div><br><br>


            <!-- Dynamic Dropdown for Job Schedule -->
            <div class="form-group">
                <label><strong>Job Schedule:</strong></label>
                @foreach($jobSchedules as $schedule)
                <label>
                    <input type="checkbox" name="job_schedules[]" value="{{ $schedule->id }}">
                    {{ $schedule->name }}
                </label>
                @endforeach

            </div><br><br>

            <!-- Gender Requirement -->
        <div class="form-group">
             <label for="gender_requirement" id="gender_requirement"><strong>Gender Requirement:</strong></label>
             <select name="gender_requirement" id="gender_requirement_select">

                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="male/female">Male/Female</option>
            </select>

            </div><br><br>
            {{-- START TO DATE --}}
            <div class="form-group">
                <label><strong>Is there a planned start date for this job?</strong></label><br>
                <input type="radio" name="has_start_date" value="yes" id="yesButton"> Yes
                <input type="radio" name="has_start_date" value="no" id="noButton" checked> No
                <div id="datePickerDiv" style="display:none;">
                    <label for="start_date_job">Start Date:</label>
                    <input type="date" name="start_date_job" id="start_date_job">
                </div>
            </div>

            {{-- DEADLINE --}}
            <div class="form-group">


                <x-label for="job_deadline" value="{{ __('Job Deadline') }}" />
                <x-input type="date" name="job_deadline" id="job_deadline" class="form-control" min="2023-01-01" onfocus="this.type='date'"/>
            </div><br>

            <div class="flex justify-between mt-4">
            <x-button type="button" class="btn" onclick="prevStep(1)">Previous</x-button>
            <x-button type="button" class="btn" onclick="nextStep(3)">Next</x-button>
            </div>
            </div>


<!-- Step 3: Add Salary -->
<div class="form-step" id="step3">
    <!-- Salary Grade Selection -->
    <div class="form-group mb-4">
      <label for="salary_grade" class="block mb-2"><strong>Salary Grade:</strong></label>
      <select name="salary_grade" id="salary_grade" class="border p-3 rounded" required onchange="updateMonthlySalary()">
        <option value="">Select Salary Grade</option>
        @foreach ($salaryGrades as $grade)
          <option value="{{ $grade->grade }}">{{ $grade->grade }}</option>
        @endforeach
      </select>
    </div>

    <!-- Display Monthly Salary Based on Selected Grade -->
    <div class="form-group mb-4">
      <label class="block mb-2"><strong>Monthly Salary:</strong></label>
      <input type="text" id="monthly_salary" readonly class="border p-2 rounded" placeholder="Monthly Salary will display here" />
      <!-- Hidden input to store the numeric salary value for submission -->
      <input type="hidden" id="monthly_salary_numeric" name="monthly_salary" />
    </div>
    <div class="flex justify-between mt-4">
      <x-button type="button" class="btn" onclick="prevStep(2)">Previous</x-button>
      <x-button type="button" class="btn" onclick="nextStep(4)">Next</x-button>
    </div>
  </div>


        <!-- Step 4: eligibility, Qualification, Training -->
        <div class="form-step" id="step4">
            <div class="form-group">
                <x-label for="eligibility" value="{{ __('Eligibility') }}" />
                <select id="eligibility" name="eligibility" class="form-control">
                    <option value="" disabled selected>Select Eligibility</option>
                    @foreach($eligibilities as $eligibility)
                    <option value="{{ $eligibility->id }}">{{ $eligibility->name }}</option>
                    @endforeach
                </select>

            </div>


{{-- QUALIFICATION --}}
<div x-data="{qualifications: []}" id="qualifications-container" class="space-y-4">
    <x-label for="eligibility" value="{{ __('Qualification') }}" />

    <template x-for="(qualification, index) in qualifications" :key="index">
        <div class="flex flex-wrap items-center space-x-2">
            <select name="qualifications[type][]" x-model="qualification.type" class="border p-2 rounded w-1/4">
                <option value="">Select Type</option>
                <option value="experience">Experience</option>
                <option value="degree">Degree</option>
                <option value="certifications">Certifications</option>
                <option value="eligibility">Eligibility</option>
            </select>

           <!-- Requirement input field, visible only when 'Degree', 'Experience', 'Certifications', or 'Eligibility' is not selected -->
        <template x-if="qualification.type !== 'degree' && qualification.type !== 'experience' && qualification.type !== 'certifications' && qualification.type !== 'eligibility'">
            <input type="text" name="qualifications[requirement][]" x-model="qualification.requirement" placeholder="Requirement" class="border p-2 rounded w-1/4">
        </template>


            <!-- Experience Duration Dropdown, visible only when 'Experience' is selected -->
            <template x-if="qualification.type === 'experience'">
                <select name="qualifications[requirement][]" x-model="qualification.requirement" class="border p-2 rounded w-1/4">
                    <option value="">Select Duration</option>
                    <option value="3 months">3 months</option>
                    <option value="6 months">6 months</option>
                    <option value="1 year">1 year</option>
                    <option value="2 years">2 years</option>
                    <option value="3 years">3 years</option>
                    <option value="4 years">4 years</option>
                    <option value="5 years">5 years</option>
                </select>
            </template>

            <!-- Degree Dropdown, visible only when 'Degree' is selected -->
            <template x-if="qualification.type === 'degree'">
                <select name="qualifications[requirement][]" x-model="qualification.requirement" class="border p-2 rounded w-1/4">
                    <option value="">Select Degree</option>
                    <option value="Elementary UnderGraduate">Elementary UnderGraduate</option>
                    <option value="Elementary Graduate">Elementary Graduate</option>
                    <option value="HighSchool UnderGraduate">HighSchool UnderGraduate</option>
                    <option value="HighSchool Graduate">HighSchool Graduate</option>
                    <option value="College UnderGraduate">College UnderGraduate</option>
                    <option value="College Graduate">College Graduate</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="Doctorate">Doctorate</option>
                </select>
            </template>

               <!-- Certifications Dropdown, visible only when 'Certifications' is selected -->
        <template x-if="qualification.type === 'certifications'">
            <select name="qualifications[requirement][]" x-model="qualification.requirement" class="border p-2 rounded w-1/4">
                <option value="">Select Certification</option>
                <option value="Certified Public Accountant (CPA)">Certified Public Accountant (CPA)</option>
                <option value="Certified Management Accountant (CMA)">Certified Management Accountant (CMA)</option>
                <option value="Chartered Financial Analyst (CFA)">Chartered Financial Analyst (CFA)</option>
                <option value="Certified Government Financial Manager (CGFM)">Certified Government Financial Manager (CGFM)</option>
                <option value="Certified Health Education Specialist (CHES)">Certified Health Education Specialist (CHES)</option>
                <option value="Certified in Public Health (CPH)">Certified in Public Health (CPH)</option>
                <option value="NCIII Driving">NCIII Driving</option>
                <option value="NCII Driving">NCII Driving</option>
                <option value="Library Technical Assistants (LTA)">Library Technical Assistants (LTA)</option>
                <option value="Professional Regulation Commission (PRC)">Professional Regulation Commission (PRC)</option>
                <option value="Master of Library and Information Science (MLIS)">Master of Library and Information Science (MLIS)</option>
            </select>
        </template>

         <!-- Eligibility Dropdown, visible only when 'Eligibility' is selected -->
         <template x-if="qualification.type === 'eligibility'">
            <select name="qualifications[requirement][]" x-model="qualification.requirement" class="border p-2 rounded w-1/4">
                <option value="">Select Eligibility</option>
                <option value="Career Service (subprofessional) First level Eligibility">Career Service (subprofessional) First level Eligibility</option>
                <option value="Career Service (subprofessional) Second level Eligibility">Career Service (subprofessional) Second level Eligibility</option>
                <option value="Career Service (Professional) Second Level Eligibility">Career Service (Professional) Second Level Eligibility</option>
                <option value="Career Service (Professional) First Level Eligibility">Career Service (Professional) First Level Eligibility</option>
                <option value="Mason(MC 11, s. 96 - Cat. III)">Mason(MC 11, s. 96 - Cat. III)</option>
                <option value="Driver's License">Driver's License</option>
                <option value="RA 1080 (Veterinarian)">RA 1080 (Veterinarian)</option>
                <option value="Electrician MC11 s1996 Cat II">Electrician (MC 11, s. 1996-Cat. II)</option>
                <option value="Heavy Equipment Operator">Heavy Equipment Operator</option>
            </select>
        </template>

        <input type="number" name="qualifications[priorityScore][]" x-model="qualification.priorityScore" placeholder="Priority Score" class="border p-2 rounded w-1/4">

        <button type="button" @click="qualifications.splice(index, 1)" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Remove</button>
    </div>
</template>



    <div class="mt-2">
        <button type="button" @click="qualifications.length < 4 ? qualifications.push({type: '', requirement: '', priorityScore: ''}) : null" :disabled="qualifications.length >= 4" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add Qualification
        </button>
    </div>

    {{-- Hidden input to store stringified JSON of qualifications --}}
    <input type="hidden" id="qualifications-data" name="qualifications_data" x-bind:value="JSON.stringify(qualifications)">

    <p x-show="qualifications.length >= 4" class="text-red-500">You can only add up to 4 qualifications.</p>
</div>




            {{-- TRAINING --}}
            <div class="form-group">
                <x-label for="training" value="{{ __('Training') }}" />
                <textarea id="training" name="training"></textarea>
            </div>

            <x-button type="button" class="btn" onclick="prevStep(3)">Previous</x-button>
            <x-button type="button" class="btn" onclick="nextStep(5)">Next</x-button>


            </div>

            <!-- Step 5: Job Competency -->
              <div class="form-step" id="step5">
                {{-- Competency --}}
                <div class="form-group">
                    <x-label for="competency" value="{{ __('Competency') }}" />
                    <textarea id="competency" name="competency"></textarea>
                </div><br>
                <div class="flex justify-between mt-4">
                <x-button  type="button" class="btn" onclick="prevStep(4)">Previous</x-button>
                <x-button  type="button" class="btn" onclick="nextStep(6)">Next</x-button>
                </div>

            </div>

            <!-- Step 6: Preferences -->
            <div class="form-step" id="step6">
                {{-- CONTACT AND EMAIL --}}
                <div class="form-group">
                    <x-label for="contact_email" value="{{ __('Contact Email') }}" />
                    <x-input id="contact_email" type="email" name="contact_email" required class="wide-input" />
                </div>
                {{-- PHONE --}}
                <div class="form-group">
                    <x-label for="contact_phone" value="{{ __('Contact Phone') }}" />
                    <x-input id="contact_phone" type="tel" name="contact_phone" required class="wide-input" />
                </div><br>
                <div class="flex justify-between mt-4">
                <x-button type="button" class="btn" onclick="prevStep(5)">Previous</x-button>
                <x-button type="button" class="btn" onclick="nextStep(7)">Next</x-button>
                </div>

                </div>

     <!-- Step 7: Review Details -->
     <div class="form-step" id="step7">

         <div id="reviewDetails">
        <!-- Details will be populated here -->
         </div><br>
         <div class="flex justify-between mt-4">
         <x-button type="button" class="btn" onclick="prevStep(6)">Previous</x-button>
         <x-button type="submit" class="btn btn-primary">{{ __('Post Job') }}</x-button>
         </div>
    </div>






        </form>
    </div>
    </div>
                </div>
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
