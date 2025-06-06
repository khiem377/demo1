<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['job_id', 'fullname', 'phone', 'email', 'birthday', 'cv_file'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
