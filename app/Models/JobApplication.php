<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id', 'fullname', 'birthday', 'phone', 'email',
        'experience', 'has_cv', 'cv_url', 'desired_salary', 'agree'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
