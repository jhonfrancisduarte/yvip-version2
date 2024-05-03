<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerEventsAndTrainings extends Model
{
    use HasFactory;

    protected $table = 'volunteer_events_and_trainings';

    protected $fillable = [
        'user_id',
        'event_type',
        'event_name',
        'organizer_facilitator',
        'start_date',
        'end_date',
        'volunteer_hours',
        'volunteer_category',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('event_name', 'like', $term)
                ->orWhere('organizer_sponsor', 'like', $term);
        });
    }

}