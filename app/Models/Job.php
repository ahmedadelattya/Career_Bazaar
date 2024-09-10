<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Job extends Model
{
    use HasFactory;
    protected $table = "job_listings";
    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'category',
        'location',
        'salary_type',
        'fixed_salary',
        'hourly_rate',
        'skills',
        'status',
        'job_type',
        'work_place',
        'experience_level'
    ];

    protected $casts = [
        'skills' => 'array', // Cast skills as array
    ];

    // Relation Between jobs and Employer
    public function user()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
