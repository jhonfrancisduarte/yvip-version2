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
    ];


    public function all_skills(){
        return $this->hasMany(Skills::class, 'category_id', 'id');
    }

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('all_categories_name', 'like', $term)
                ->orWhere('description', 'like', $term);
        });
    }

}
