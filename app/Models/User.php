<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Job;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_name',
        'website',
        'about',
        'image',
        'candidate_skills',
        'candidate_projects',
        'candidate_job_title',
        'candidate_job_description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getCandidateSkillsAttribute($value)
    {
        return json_decode($value, true); // Convert JSON string to array
    }


    public function setCandidateSkillsAttribute($value)
    {
        $this->attributes['candidate_skills'] = json_encode($value); // Convert array to JSON string
    }

    public function getCandidateProjectsAttribute($value)
    {
        return json_decode($value, true);
    }

    // Mutator: Convert array to JSON string for candidate_projects
    public function setCandidateProjectsAttribute($value)
    {
        $this->attributes['candidate_projects'] = json_encode($value);
    }
    // Relation Between jobs and Employer
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }
}
