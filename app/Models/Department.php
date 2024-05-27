<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function head() {
        return $this->hasOne(User::class);
    }
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    public function departmentHead()
    {
    return $this->belongsTo(User::class, 'department_head_id');
    }


}
