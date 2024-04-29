<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimRequest extends Model
{
    use HasFactory;

    protected $table = 'claim_request';

    protected $fillable = [
        'user_id',
        'reward_id',
        'approved',
        'pending',
        // Add other fillable fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
