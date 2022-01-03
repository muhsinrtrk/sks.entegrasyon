<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'price',
        'facilityName'
    ];

    public function FacilityReservation(){
        return $this->hasMany(FacilityReservation::class,'facilityId' ,'id');
    }
}
