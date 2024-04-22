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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function all_skills()
    {
        return $this->belongsTo(Skills::class);
    }
}
