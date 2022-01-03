<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuesthouseReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'roomNumber',
        'numberOfPeople',
        'status',
        'academicalPersonalId',
        'guesthouseId'
    ];

    public function AcademicalPersonal()
    {
        return $this->belongsTo(AcademicalPersonal::class, 'academicalPersonalId');
    }
    public function Guesthouse()
    {
        return $this->belongsTo(Guesthouse::class, 'guesthouseId');
    }
}
