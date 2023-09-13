<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id', 'title', 'description', 'salary', 'work_type', 'location'
    ];

    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    public function bookmark() : HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
