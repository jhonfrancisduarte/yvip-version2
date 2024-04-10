<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class UserData extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_data';

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
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
        'selectedProvince',
        'selectedCity',
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
    ];
}
