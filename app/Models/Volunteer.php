<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{

    protected $fillable = [
        'user_id',
        'category_id',
        'volunteer_experience',
        'volunteering_hours',
        // Add other fillable fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function volunteer_category()
    {
        return $this->belongsTo(VolunteerCategory::class);
    }

    public function leaderboard(){
        return $this->hasOne(VolunteersLeaderboard::class);
    }
}
