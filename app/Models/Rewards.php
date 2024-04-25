<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $fillable = [
        'level',
        'number_of_hours',
        'all_rewards',
        // Add other fillable fields as needed
    ];
}
