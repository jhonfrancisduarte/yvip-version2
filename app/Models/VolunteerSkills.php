<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerSkills extends Model
{
    protected $fillable = [
        'skill_name',
        'description',
        // Add other fillable fields as needed
    ];
}
