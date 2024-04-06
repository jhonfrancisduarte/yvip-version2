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
        'passport_number',
        'first_name',
        'last_name',
        'middle_name',
        'nickname',
        'date_of_birth',
        'civil_status',
        'age',
        'nationality',
        'tel_number',
        'mobile_number',
        'email',
        'blood_type',
        'sex',
        'permanent_address',
        'residential_address',
        'educational_background',
        'status',
        'nature_of_work',
        'employer',
        'profile_picture',
        'name_of_school',
        'course',
        'organization_name',
        'org_position',
        'is_volunteer',
        'is_ip_participant',
        'password',
    ];
    

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
