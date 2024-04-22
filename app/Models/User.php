<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'name',
        'user_role',
        'active_status',
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

    public function volunteer(){
        return $this->hasOne(Volunteer::class);
    }

    public function volunteer_skills(){
        return $this->hasMany(VolunteerSkills::class, 'all_skills_id', 'id');
    }

    public function volunteer_categories(){
        return $this->hasOne(VolunteerCategory::class);
    }

    public function ipEvents(){
        return $this->hasMany(IpEvents::class);
    }

    public function ipPostProgramObligation(){
        return $this->hasMany(IpPostProgramObligation::class);
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

    public function scopeSearch2($query, $term){
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('admin.first_name', 'like', $term)
                ->orWhere('admin.last_name', 'like', $term)
                ->orWhere('admin.middle_name', 'like', $term)
                ->orWhere('email', 'like', $term);
        });
    }

    protected static function boot()
    {
        parent::boot();


        static::saved(function ($user) {

            if ($user->userData) {

                $user->name = $user->userData->first_name . ' ' . $user->userData->last_name;

                $user->saveQuietly();
            }
        });
    }
}
