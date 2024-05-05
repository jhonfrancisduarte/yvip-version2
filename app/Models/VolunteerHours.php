<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerHours extends Model
{
    use HasFactory;

    protected $table = 'volunteer_hours';

    protected $fillable = [
        'user_id',
        'event_id',
        'volunteering_hours',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function volunteerEventsAndTrainings(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $term){
        return $query->whereHas('user', function ($q) use ($term) {
            $q->where('name', 'like', '%' . $term . '%');
        });
    }

}
