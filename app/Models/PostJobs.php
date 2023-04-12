<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostJobs extends Model
{
    use HasFactory;

    protected $table = 'post_jobs';

    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'job_title',
        'job_poster',
        'company',
        'location',
        'skills',
        'qualification',
        'exp_from',
        'exp_to',
        'employee_type_id',
        'salary_from',
        'salary_to',
        'description',
    ];

    public function employeeType(){
        return $this->belongsTo(EmployeeTypes::class, 'employee_type_id', 'id');
    }
}
