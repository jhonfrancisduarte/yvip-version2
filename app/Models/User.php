<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'name',
        'user_role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userData()
    {
        return $this->hasOne(UserData::class);
    }

    public function announcement()
    {
        return $this->hasOne(Announcement::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
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

    // Define an event listener to automatically update the name attribute
    protected static function boot()
    {
        parent::boot();

        // Listen for the saved event of the User model
        static::saved(function ($user) {
            // Check if the associated UserData exists
            if ($user->userData) {
                // Update the name attribute based on the UserData
                $user->name = $user->userData->first_name . ' ' . $user->userData->last_name;
                // Save the updated User model
                $user->saveQuietly(); // Save quietly to avoid triggering the saved event again
            }
        });
    }
}
