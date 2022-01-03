<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guesthouse extends Model
{
    use HasFactory;


    protected $fillable = [
        'roomNumber',
        'numberOfPeople',
        'status',
    ];

    public function GuesthouseReservation()
    {
        return $this->hasMany(GuesthouseReservation::class,'guesthouseId','id');
    }
}
