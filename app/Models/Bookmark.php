<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = ['job_id','job_seeker_id'];

    public function jobSeeker() : BelongsTo 
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function job() : BelongsTo 
    {
        return $this->belongsTo(Job::class);
    }
}
