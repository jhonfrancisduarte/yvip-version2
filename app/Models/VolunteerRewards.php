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
        'rewards',
        'award_date',
        'claim_status',
        'claim_date',
        // Add other fillable fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
