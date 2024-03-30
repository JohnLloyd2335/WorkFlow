<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class JobSeeker extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id', 'resume_file_path', 'highest_education', 'date_graduated', 'field_of_study', 'school_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function bookmark(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}
