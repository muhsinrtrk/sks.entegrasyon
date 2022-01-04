<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\SksAdmin;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class FilterService
{
    public static function filterReservation($input)
    {
        if (Auth::user() instanceof Student) {
            $student = Student::find(Auth::user()->getAuthIdentifier());
            $result = $student->FacilityReservation;
            return $result;
        } elseif (Auth::user() instanceof AcademicalPersonal) {
            $academicalPersonal = AcademicalPersonal::find(Auth::user()->getAuthIdentifier());
            $result = $academicalPersonal->FacilityReservation;
            return $result;
        } else {
            return $input;
        }
    }
}
