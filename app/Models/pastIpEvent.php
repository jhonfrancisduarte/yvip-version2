<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pastIpEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_name',
        'organizer_sponsor',
        'sponsor_category',
        'start',
        'end',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}



