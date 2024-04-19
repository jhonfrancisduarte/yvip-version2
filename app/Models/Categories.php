<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'all_categories';

    protected $fillable = [
        'all_categories_name',
        'description',
        // Add other fillable fields as needed
    ];

    public function volunteer_categories()
    {
        return $this->hasOne(VolunteerCategory::class);
    }

    public function all_skills()
    {
        return $this->hasMany(Skills::class, 'category_id', 'id');
    }
}
