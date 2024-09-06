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
        'category',
        'location',
        'salary_type',
        'fixed_salary',
        'hourly_rate',
        'skills',
        'status'
    ];

    protected $casts = [
        'skills' => 'array', // Cast skills as array
    ];

    // Relation Between jobs and Employer
    public function user()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}