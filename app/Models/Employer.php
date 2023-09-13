<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','company_name','company_description','services'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobsPosted()
    {
        return $this->hasOne(Job::class, 'employer_id');
    }
}
