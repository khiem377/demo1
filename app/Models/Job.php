<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'address', 'type', 'description', 'salary', 'deadline'];

    protected $dates = ['deadline'];
}
