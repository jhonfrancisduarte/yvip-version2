<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerEventsAndTrainings extends Model
{
    use HasFactory;

    protected $table = 'volunteer_events_and_trainings';

    protected $fillable = [
        'event_type',
        'event_name',
        'organizer_facilitator',
        'start_date',
        'end_date',
        'volunteer_hours',
        'volunteer_category',
    ];

}
