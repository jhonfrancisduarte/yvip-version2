<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerCategory extends Model
{
    protected $fillable = [
        'category_name',
        'description',
        // Add other fillable fields as needed
    ];
}
