<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerExperience extends Model
{
    use HasFactory;

    protected $table = 'volunteer_experience';

    protected $fillable = [
        'user_id',
        'nature_of_event',
        'participation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
