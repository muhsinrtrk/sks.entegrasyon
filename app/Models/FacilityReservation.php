<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'facilityId',
        'academicalPersonalId',
        'reservastionDate'
    ];
    public function Facility()
    {
        return $this->belongsTo(Facility::class, 'facilityId');
    }

    public function Student()
    {
        return $this->belongsTo(Student::class, 'studentId');
    }

    public function AcademicalPersonal()
    {
        return $this->belongsTo(AcademicalPersonal::class, 'academicalPersonalId');
    }
}
