<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerCategory extends Model
{
    protected $fillable = [
        'user_id',
        'category_name',
        'description',
        // Add other fillable fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

}
