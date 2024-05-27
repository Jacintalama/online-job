<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\CreateNewUser;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Models\JobApplication;
use App\Models\Qualification;
use App\Models\ApplicantRecord;


class User extends Authenticatable
{
    use WithFileUploads;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    const ROLE_DEPARTMENTHEAD = 'department_head';
    const ROLE_APPLICANT = 'applicant';
    const ROLE_ADMIN = 'admin';

    public static $roles = [
    self::ROLE_DEPARTMENTHEAD,
    self::ROLE_APPLICANT,
    self::ROLE_ADMIN,
    ];
    public $state = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'first_name',
        'middle_initial',
        'last_name',
        'name',
        'email',
        'password',
        'photo',
        'department_head_name',
        'dob',
        'role',
        'is_approved',
        'gender', // Add this line
        'street_no',
        'barangay',
        'municipality',
        'province',
        'city',
        'highest_education',
        'school_location',
        'degree',
        'skills',
        'job_experience',
        'job_location',
        'company_name',
        'achievements',
        'certifications',
        'eligibility',

    ];
    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strtolower($value);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function getProfilePhotoUrlAttribute()
    {
    return $this->profile_photo_path
                ? Storage::disk('public')->url($this->profile_photo_path)
                : $this->defaultProfilePhotoUrl();
    }

    public function isDepartmentHead()
    {
    return $this->role === 'department_head';
    }

    public function isApplicant()
    {
    return $this->role === 'applicant';
    }

    public function isAdmin()
    {
    return $this->role === 'admin';
    }

    public function redirectTo()
    {
    switch ($this->role) {
        case 'admin':
            return '/admin/dashboard';
        case 'department_head':
            return '/departmenthead/dashboard';
        case 'applicant':
            return '/applicant/dashboard';
        default:
            return '/dashboard';
    }
}

/**
 * Get the users who have applied to this job.
 */
    public function applicants()
    {
        return $this->belongsToMany(User::class, 'applications')->withTimestamps();  // if your pivot table has timestamp fields
    }
/**
 * Get the applications for this job.
 * Useful for accessing additional data about each application (e.g., a CV).
 */
    public function applications()
    {
    return $this->hasMany(JobApplication::class);
    }

    // In your User model

    public function bookmarks()
    {
    return $this->hasMany(Bookmark::class);
    }



     /**
     * Get the messages sent by the user.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Get the messages received by the user.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
    public function unreadMessagesCount()
    {
        return $this->messagesReceived()->whereNull('read_at')->count();
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'recipient_id');
    }
    public function markAsRead()
    {
        $this->update(['is_read' => true, 'read_at' => now()]);
    }



    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function hasAppliedForJob(Job $job)
    {
        // Example logic: check if a record exists in a job_applications table
        // with the current user's ID and the provided job's ID.
        return $this->jobApplications()->where('job_id', $job->id)->exists();
    }

    public function applyForJob(Job $job)
    {
        // Example logic: create a record in a job_applications table
        // with the current user's ID and the provided job's ID.
        $this->jobApplications()->create(['job_id' => $job->id]);
    }

    public function jobApplications()
    {
        // Define a relationship between the User and JobApplication models.
        // Assumes you have a JobApplication model and corresponding job_applications table.
        return $this->hasMany(JobApplication::class);
    }
  // User.php model
public function department()
{
    return $this->belongsTo(Department::class, 'department_head_name', 'name','department_id');
}

public function hasBeenHired()
{
    return ApplicantRecord::where('user_id', $this->id)->where('status', 'hired')->exists();
}

public function jobsPosted()
{
    return $this->hasMany(Job::class, 'department_head_id','department_id');
}


public function headedDepartment()
{
    return $this->hasOne(Department::class, 'department_head_id');
}



public function hasRole($role)
{
    return $this->role === $role;
}
}




