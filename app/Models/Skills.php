<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'all_skills';

    protected $fillable = [
        'category_id',
        'all_skills_name',
        'description',
        // Add other fillable fields as needed
    ];

    public function volunteer_skills()
    {
        return $this->hasMany(VolunteerSkills::class, 'all_skills_id');
    }

    public function all_categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
