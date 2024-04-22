<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name_of_events', 
        'organizer', 
        'date', 
        'volunteering_hours', 
        'volunteer_category'
    ];
}
