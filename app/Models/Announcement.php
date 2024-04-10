<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Announcement extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'announcement';
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id', 
        'title',
        'category',
        'content',
        'type',
        'featured_image',
        'attached_file',
    ];

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('announcement.title', 'like', $term)
                ->orWhere('announcement.content', 'like', $term);
        });
    }
}
