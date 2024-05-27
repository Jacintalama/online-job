<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ApplicantRecord;

class JobApplication extends Model
{
    use HasFactory;
    protected $table = 'job_applications';
    protected $fillable = ['user_id', 'job_id','status','matching_score'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function getStatusLabelAttribute()
    {
        // Define human-readable labels for each status
        $labels = [
            'applied' => 'Applied',
            'hired' => 'Hired',
            'rejected' => 'Rejected',
            // Add more status labels as needed
        ];

        // Return the human-readable status label, or the original status if a label is not defined
        return $labels[$this->status] ?? $this->status;
    }

    public function applicantRecords()
{
    return $this->hasOne(ApplicantRecord::class, 'user_id', 'user_id');
}



}



