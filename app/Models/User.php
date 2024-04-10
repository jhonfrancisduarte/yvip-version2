<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'user_role',
    ];

    public function userData(){
        return $this->hasOne(UserData::class);
    }
    public function announcement(){
        return $this->hasOne(Announcement::class);
    }

    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function scopeSearch($query, $term){
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('user_data.first_name', 'like', $term)
                ->orWhere('user_data.last_name', 'like', $term)
                ->orWhere('user_data.middle_name', 'like', $term)
                ->orWhere('user_data.nickname', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('user_data.passport_number', 'like', $term)
                ->orWhere('user_data.date_of_birth', 'like', $term)
                ->orWhere('user_data.civil_status', 'like', $term)
                ->orWhere('user_data.nationality', 'like', $term);
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
