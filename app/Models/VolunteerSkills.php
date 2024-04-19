<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerSkills extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'skill_name',
        'description',
        // Add other fillable fields as needed
    ];

    public function user_volunteer_skills()
    {
        return $this->hasOne(UserVolunteerSkills::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function all_skills()
    {
        return $this->belongsTo(Skills::class);
    }
}
