<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVolunteerSkills extends Model
{
    // Define the table associated with the model
    protected $table = 'user_volunteer_skills';

    // Disable timestamps for this model
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'skill_id',
        // Add other fillable fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill()
    {
        return $this->belongsTo(VolunteerSkill::class);
    }
}
