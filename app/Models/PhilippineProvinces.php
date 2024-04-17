<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineProvinces extends Model
{
    use HasFactory;
    protected $fillable = [
        'psgc_code',
        'province_description',
        'region_code',
        'province_code',
    ];

    public function userData(){
        return $this->hasMany(PhilippineCities::class);
    }
}
