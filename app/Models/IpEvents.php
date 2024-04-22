<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpEvents extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_name',
        'organizer_sponsor',
        'start',
        'end',
        'qualifications',
        'participants',
        'join_requests',
        'disapproved',
        'join_status',
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
