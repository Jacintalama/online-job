<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\JobType;
use App\Models\JobSchedule;
use App\Models\Eligibility;
use App\Models\User;
use App\Models\Qualification;
use App\Models\JobApplication;


class Job extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'department_head_id','position_title', 'competency', 'training', 'eligibility',
        'contact_email', 'contact_phone',
        'job_deadline', 'gender_requirement', 'department_id', 'start_date_job','has_start_date','salary_grade',
        'monthly_salary', 'status','is_closed',
    ];

    protected $dates = [
        'job_deadline',
        'created_at',
        'updated_at',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }




    public function jobTypes()
    {
        return $this->belongsToMany(JobType::class);
    }

    public function jobSchedules()
    {
        return $this->belongsToMany(JobSchedule::class);
    }
    public function departmenthead()
    {
    return $this->belongsTo(User::class, 'department_head_id');
    }

    public function eligibilities()
    {
    return $this->belongsToMany(Eligibility::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class, 'department_head_id'); // Assuming 'department_head_id' is the foreign key in the jobs table that refers to the user.
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function qualifications()
    {
    return $this->hasMany(Qualification::class);
    }

    public function getMaxScoreAttribute()
    {
         return $this->qualifications->sum('priority_score');
    }

}
