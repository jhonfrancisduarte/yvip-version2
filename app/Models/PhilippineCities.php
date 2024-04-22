<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineCities extends Model
{
    use HasFactory;
    protected $fillable = [
        'psgc_code',
        'city_municipality_description',
        'region_description',
        'province_code',
        'city_municipality_code',
    ];
    
    public function user(){
        return $this->belongsTo(PhilippineProvinces::class);
    }
}
