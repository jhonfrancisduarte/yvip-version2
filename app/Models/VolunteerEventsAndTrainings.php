<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerEventsAndTrainings extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'event_name',
        'organizer_facilitator',
        'date',
        'volunteering_hours',
        'volunteer_category',
    ];

    protected $table = 'volunteer_events_and_trainings';
    public $timestamps = true;
}
