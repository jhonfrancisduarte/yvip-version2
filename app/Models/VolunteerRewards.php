<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerRewards extends Model
{
    use HasFactory;

    protected $table = 'volunteer_rewards';

    protected $fillable = [
        'user_id',
        'number_of_hours',
        'reward_id',
        'request_date',
        'request_status',
        'claim_status',
        'claim_date',
    ];

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->whereHas('user', function ($query) use ($term) {
                $query->where('name', 'like', $term);
            });
        });
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reward(){
        return $this->belongsTo(Rewards::class);
    }
}
