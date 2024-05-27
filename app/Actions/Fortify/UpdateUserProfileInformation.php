<?php

namespace App\Actions\Fortify;

use App\Models\Barangay;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Region;
use App\Models\User;
use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Features\SupportFileUploads\WithFileUploads;



class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    use WithFileUploads;
    public $back_id;
    public $front_id;

    public $state = [];

    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */



    public function update(User $user, array $input): void
    {

        // Log::info(json_encode($this->state));
        // Log::info(json_encode($input));

        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_initial' => ['nullable', 'string', 'max:1'],
            'last_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'department_head_name' => ['nullable', 'string', 'max:255'],
            'dob' => 'nullable|date|before_or_equal:2000-12-31',
            'street_no' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'municipality' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],

            'highest_education' => ['nullable', 'string', 'max:255'],
            'school_location' => ['nullable', 'string', 'max:255'],
            'degree' => ['nullable', 'string', 'max:255'],
            'skills' => ['nullable', 'string'], // Adjust validation rules as needed
            'job_experience' => ['nullable', 'string'], // Adjust validation rules as needed
            'job_location' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'achievements' => ['nullable', 'string'], // Adjust validation rules as needed
            'certifications' => ['nullable', 'string'], // Adjust validation rules as needed
            'eligibility' => 'required|string|max:255',

        ])->validateWithBag('updateProfileInformation');


        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if (isset($this->state['dob'])) {
            $dob = Carbon::parse($this->state['dob']);
            $this->state['age'] = $dob->diffInYears(Carbon::now());
        }




      

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'first_name' => $input['first_name'],
                'middle_initial' => $input['middle_initial'],
                'last_name' => $input['last_name'],
                'name' => $input['name'],
                'email' => $input['email'],
                'department_head_name' => $input['department_head_name'],
                'dob' => $input[ 'dob'],

                'gender' => $input['gender'],
                'street_no' => $input['street_no'],
                'barangay' => $input['barangay'], // Add this line
                'municipality' => $input['municipality'],
                'province' => $input['province'],
                'city' => $input['city'],

                'highest_education' => $input['highest_education'], // Add this line
                'school_location' => $input['school_location'], // Add this line
                'degree' => $input['degree'], // Add this line
                'skills' => $input['skills'], // Add this line
                'job_experience' => $input['job_experience'], // Add this line
                'job_location' => $input['job_location'], // Add this line
                'company_name' => $input['company_name'], // Add this line
                'achievements' => $input['achievements'], // Add this line
                'certifications' => $input['certifications'], // Add this line
                'eligibility' => $input['eligibility'],
            ])->save();
        }

    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */



    public function updatedStateDob()
    {
    if (isset($this->state['dob'])) {
        $dateOfBirth = new DateTime($this->state['dob']);
        $today = new DateTime('today');
        $this->state['age'] = $dateOfBirth->diff($today)->y;
    }
    }

    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'department_head_name' => $input['department_head_name'],
            'dob' => $input['dob'],
        ])->save();


        $user->sendEmailVerificationNotification();
    }
}
