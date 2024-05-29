<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pastIpEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_name',
        'organizer_sponsor',
        'sponsor_category',
        'start',
        'end',
        'confirmed',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('past_ip_events.event_name', 'like', $term)
                  ->orWhere('past_ip_events.organizer_sponsor', 'like', $term)
                  ->orWhere('users.name', 'like', $term);
        });
    }
    
}



