<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}

    </x-slot>

    <x-slot name="form">

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model.live="photo"
                       x-ref="photo"
                       x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                       " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    @if ($this->user->profile_photo_path)
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                    @else
                        <!-- Display a different default avatar based on the user's role -->
                        @if ($this->user->role == 'applicant')
                            <img src="{{ asset('images/default-applicant-avatar.png') }}" alt="Default Applicant Avatar" class="rounded-full h-20 w-20 object-cover">
                        @elseif ($this->user->role == 'department_head')
                            <img src="{{ asset('images/default-department_head-avatar.png') }}" alt="Default DP HEAD Avatar" class="rounded-full h-20 w-20 object-cover">
                        @elseif ($this->user->role == 'admin')
                            <img src="{{ asset('images/default-admin-avatar.png') }}" alt="Default Admin Avatar" class="rounded-full h-20 w-20 object-cover">
                        @endif
                    @endif
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('UserName') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

      <!-- First Name -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="first_name" value="{{ __('First Name') }}" />
    <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model="state.first_name" required autocomplete="given-name" />
    <x-input-error for="first_name" class="mt-2" />
</div>

<!-- Middle Initial -->
<div class="col-span-6 sm:col-span-1">
    <x-label for="middle_initial" value="{{ __('Middle Initial') }}" />
    <x-input id="middle_initial" type="text" maxlength="1" class="mt-1 block w-full" wire:model="state.middle_initial" autocomplete="additional-name" />
    <x-input-error for="middle_initial" class="mt-2" />
</div>

<!-- Last Name -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="last_name" value="{{ __('Last Name') }}" />
    <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="state.last_name" required autocomplete="family-name" />
    <x-input-error for="last_name" class="mt-2" />
</div>


        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />

            <!-- Input field for user's email -->
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />

            <!-- Error message for email input -->
            <x-input-error for="email" class="mt-2" />

            <!-- Display email verification message if email is not verified -->
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}
                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                <!-- Notification when a new verification link has been sent -->
                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Additional fields for Department Head -->
@if($this->user->role == 'departmenthead')

{{-- <!-- Department Head Name -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="department_head_name" value="{{ __('Department Head Name') }}" />
    <x-input id="department_head_name" type="text" class="mt-1 block w-full" wire:model="state.department_head_name" />
    <x-input-error for="department_head_name" class="mt-2" />
</div> --}}


{{-- <!-- Date of Birth -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="dob" value="{{ __('Date of Birth') }}" />
    <x-input id="dob" type="date" class="mt-1 block w-full" wire:model="state.dob" max="2000-12-31" />
    <x-input-error for="dob" class="mt-2" />
</div> --}}

{{-- <!-- Age -->
<div class="col-span-6 sm:col-span-1">
    @php
        $ageDisplay = null;
        if (isset($state['dob']) && !empty($state['dob'])) {
            $dateOfBirth = new DateTime($state['dob']);
            $today = new DateTime('today');
            $age = $dateOfBirth->diff($today)->y;
            $ageDisplay = $age . ' years';
        }
    @endphp
    <x-label for="age" value="{{ __('Age') }}" />
    <x-input id="age" type="text" class="mt-1 block w-full" value="{{ $ageDisplay }}" readonly />
</div>

<!-- Gender -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="gender" value="{{ __('Gender') }}" />
    <select id="gender" class="mt-1 block w-full" wire:model="state.gender">
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>

    </select>
    <x-input-error for="gender" class="mt-2" />
</div> --}}

@elseif($this->user->role == 'applicant')
<!-- Date of Birth -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="dob" value="{{ __('Date of Birth') }}" />
    <x-input id="dob" type="date" class="mt-1 block w-full" wire:model="state.dob" max="2000-12-31" />
    <x-input-error for="dob" class="mt-2" />
</div>

<!-- Age -->
<div class="col-span-6 sm:col-span-1">
    @php
        $ageDisplay = null;
        if (isset($state['dob']) && !empty($state['dob'])) {
            $dateOfBirth = new DateTime($state['dob']);
            $today = new DateTime('today');
            $age = $dateOfBirth->diff($today)->y;
            $ageDisplay = $age . ' years';
        }
    @endphp
    <x-label for="age" value="{{ __('Age') }}" />
    <x-input id="age" type="text" class="mt-1 block w-full" value="{{ $ageDisplay }}" readonly />
</div>

<!-- Gender -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="gender" value="{{ __('Gender') }}" />
    <select id="gender" class="mt-1 block w-full" wire:model="state.gender">
        <xoption value="">Select Gender</xoption>
        <option value="male">Male</option>
        <option value="female">Female</option>

    </select>
    <x-input-error for="gender" class="mt-2" />
</div>

<!-- Address Form -->
<!-- Street No./House No. -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="street_no" value="{{ __('Street No./House No.') }}" />
    <x-input id="street_no" type="text" class="mt-1 block w-full" wire:model="state.street_no" />
    <x-input-error for="street_no" class="mt-2" />
</div>
<!-- Barangay -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="barangay" value="{{ __('Barangay') }}" />
    <x-input id="barangay" type="text" class="mt-1 block w-full" wire:model="state.barangay" />
    <x-input-error for="barangay" class="mt-2" />
</div>
<!-- Municipality -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="municipality" value="{{ __('Municipality') }}" />
    <x-input id="municipality" type="text" class="mt-1 block w-full" wire:model="state.municipality" />
    <x-input-error for="municipality" class="mt-2" />
</div>

<!-- Province -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="province" value="{{ __('Province') }}" />
    <x-input id="province" type="text" class="mt-1 block w-full" wire:model="state.province" />
    <x-input-error for="province" class="mt-2" />
</div>

<!-- City -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="city" value="{{ __('City') }}" />
    <x-input id="city" type="text" class="mt-1 block w-full" wire:model="state.city" />
    <x-input-error for="city" class="mt-2" />
</div>



<!-- Education Form -->
<!-- Highest Education -->
<h3 class="text-lg font-medium mb-2 col-span-6"><br>Education<br><hr></h3>
<div class="col-span-6 sm:col-span-4">
    <x-label for="highest_education" value="{{ __('Highest Educational Attainment') }}" />
    <select id="highest_education" name="highest_education" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="state.highest_education">
        <option value="">{{ __('Select Highest Education') }}</option>
        <option value="Elementary UnderGraduate">{{ __('Elementary UnderGraduate') }}</option>
        <option value="Elementary Graduate">{{ __('Elementary Graduate') }}</option>
        <option value="HighSchool UnderGraduate">{{ __('HighSchool UnderGraduate') }}</option>
        <option value="HighSchool Graduate">{{ __('HighSchool Graduate') }}</option>
        <option value="College UnderGraduate">{{ __('College UnderGraduate') }}</option>
        <option value="College Graduate">{{ __('College Graduate') }}</option>
    </select>
    <x-input-error for="highest_education" class="mt-2" />
</div>


<!-- School Location -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="school_location" value="{{ __('School Location') }}" />
    <x-input id="school_location" type="text" class="mt-1 block w-full" wire:model="state.school_location" />
    <x-input-error for="school_location" class="mt-2" />
</div>

<!-- Degree -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="degree" value="{{ __('Degree') }}" />
    <select id="degree" name="degree" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="state.degree">
        <option value="">{{ __('Select Degree') }}</option>
        <option value="Elementary UnderGraduate">{{ __('Elementary UnderGraduate') }}</option>
        <option value="Elementary Graduate">{{ __('Elementary Graduate') }}</option>
        <option value="HighSchool UnderGraduate">{{ __('HighSchool UnderGraduate') }}</option>
        <option value="HighSchool Graduate">{{ __('HighSchool Graduate') }}</option>
        <option value="College UnderGraduate">{{ __('College UnderGraduate') }}</option>
        <option value="College Graduate">{{ __('College Graduate') }}</option>
        <option value="Bachelor's Degree">{{ __("Bachelor's Degree") }}</option>
        <option value="Master's Degree">{{ __("Master's Degree") }}</option>
        <option value="Doctorate">{{ __('Doctorate') }}</option>
    </select>
    <x-input-error for="degree" class="mt-2" />
</div>




{{-- Qualification --}}

<!-- Skills -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="skills" value="{{ __('Skills') }}" />
    <x-input id="skills" class="mt-1 block w-full" wire:model="state.skills" />
    <x-input-error for="skills" class="mt-2" />
    </div>

<!-- Experience -->
<h3 class="text-lg font-medium mb-2 col-span-6"><br>Experience<br><hr></h3>
<!-- Job Experience -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="job_experience" value="{{ __('Job Experience') }}" />
    <select id="job_experience" name="job_experience" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="state.job_experience">
        <option value="">{{ __('Select Duration') }}</option>
        <option value="3 months">{{ __('3 months') }}</option>
        <option value="6 months">{{ __('6 months') }}</option>
        <option value="1 year">{{ __('1 year') }}</option>
        <option value="2 years">{{ __('2 years') }}</option>
        <option value="3 years">{{ __('3 years') }}</option>
        <option value="4 years">{{ __('4 years') }}</option>
        <option value="5 years">{{ __('5 years') }}</option>
    </select>
    <x-input-error for="job_experience" class="mt-2" />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-label for="job_location" value="{{ __('Job Location') }}" />
    <x-input id="job_location" type="text" class="mt-1 block w-full" wire:model="state.job_location" />
    <x-input-error for="job_location" class="mt-2" />
</div>
<div class="col-span-6 sm:col-span-4">
    <x-label for="company_name" value="{{ __('Company Name') }}" />
    <x-input id="company_name" type="text" class="mt-1 block w-full" wire:model="state.company_name" />
    <x-input-error for="company_name" class="mt-2" />
</div>

{{-- QUALIFICATION --}}
<!-- Achievements -->
<h3 class="text-lg font-medium mb-2 col-span-6"><br>Qualification<br><hr></h3>
<div class="col-span-6 sm:col-span-4">
    <x-label for="achievements" value="{{ __('Achievements') }}" />
    <x-input id="achievements" class="mt-1 block w-full" wire:model="state.achievements"/>
    <x-input-error for="achievements" class="mt-2" />
</div>

<!-- Certifications -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="certifications" value="{{ __('Certifications') }}" />
    <select id="certifications" name="certifications" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="state.certifications">
        <option value="">{{ __('Select Certification') }}</option>
        <option value="Certified Public Accountant (CPA)">{{ __('Certified Public Accountant (CPA)') }}</option>
        <option value="Certified Management Accountant (CMA)">{{ __('Certified Management Accountant (CMA)') }}</option>
        <option value="Chartered Financial Analyst (CFA)">{{ __('Chartered Financial Analyst (CFA)') }}</option>
        <option value="Certified Government Financial Manager (CGFM)">{{ __('Certified Government Financial Manager (CGFM)') }}</option>
        <option value="Certified Health Education Specialist (CHES)">{{ __('Certified Health Education Specialist (CHES)') }}</option>
        <option value="Certified in Public Health (CPH)">{{ __('Certified in Public Health (CPH)') }}</option>
        <option value="NCIII Driving">{{ __('NCIII Driving') }}</option>
        <option value="NCII Driving">{{ __('NCII Driving') }}</option>
        <option value="Library Technical Assistants (LTA)">{{ __('Library Technical Assistants (LTA)') }}</option>
        <option value="Professional Regulation Commission (PRC)">{{ __('Professional Regulation Commission (PRC)') }}</option>
        <option value="Master of Library and Information Science (MLIS)">{{ __('Master of Library and Information Science (MLIS)') }}</option>
    </select>
    <x-input-error for="certifications" class="mt-2" />
</div>


<!-- Eligibility -->
<div class="col-span-6 sm:col-span-4">
    <x-label for="eligibility" value="{{ __('Eligibility') }}" />
    <select id="eligibility" name="eligibility" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="state.eligibility">
        <option value="">{{ __('Select Eligibility') }}</option>
        <option value="Career Service (subprofessional) First level Eligibility">{{ __('Career Service (subprofessional) First level Eligibility') }}</option>
        <option value="Career Service (subprofessional) Second level Eligibility">{{ __('Career Service (subprofessional) Second level Eligibility') }}</option>
        <option value="Career Service (Professional) Second Level Eligibility">{{ __('Career Service (Professional) Second Level Eligibility') }}</option>
        <option value="Career Service (Professional) First Level Eligibility">{{ __('Career Service (Professional) First Level Eligibility') }}</option>
        <option value="Mason(MC 11, s. 96 - Cat. III)">{{ __('Mason(MC 11, s. 96 - Cat. III)') }}</option>
        <option value="Driver's License">{{ __("Driver's License") }}</option>
        <option value="RA 1080 (Veterinarian)">{{ __('RA 1080 (Veterinarian)') }}</option>
        <option value="Electrician MC11 s1996 Cat II">{{ __('Electrician MC11 s1996 Cat II') }}</option>
        <option value="Heavy Equipment Operator">{{ __('Heavy Equipment Operator') }}</option>
    </select>
    <x-input-error for="eligibility" class="mt-2" />
</div>


@endif




    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
         <!-- Export Button -->
         <a href="{{ route('profile.export', ['userId' => auth()->user()->id]) }}" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            {{ __('Export') }}
        </a>


    </x-slot>


</x-form-section>

