<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\Facility;
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
            foreach ($input as $key => $item){
                $input->merge($item->Facility->get());
            }
            return $input;
        }
    }

    public static function filterFacilityStatus($input,$id = null)
    {
        if (Auth::user() instanceof Student || Auth::user() instanceof AcademicalPersonal) {
            if($id == null){
                $input = Facility::where('status', 'LIKE', '%' . 1 . '%')->get();
            }else{
                $input = Facility::where([['status', 'LIKE', '%' . 1 . '%'],['id', 'LIKE', '%' . $id . '%']])->get();
            }
            return $input;
        }else {
            return $input;
        }
    }
}
