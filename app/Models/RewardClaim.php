<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardClaim extends Model
{
    use HasFactory;

    protected $table = 'reward_claim';

    protected $fillable = [
        'user_id',
        'total_hours',
        'total_claimed_hours',
        'claimable_hours',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $term){
        return $query->whereHas('user', function ($q) use ($term) {
            $q->where('name', 'like', '%' . $term . '%');
        });
    }
}
