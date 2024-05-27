<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGrade extends Model
{
    use HasFactory;
    protected $table = 'salary_grades';
    protected $fillable = ['grade', 'amount'];
    // If you have timestamps in your table and you want to use them, otherwise set it to false
    public $timestamps = true;
}
