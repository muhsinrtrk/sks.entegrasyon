<?php

namespace App\Service;


use App\Models\Facility;
use App\Models\FacilityReservation;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    public function getFacilityReservations($input)
    {
        return FacilityReservation::all();
    }
    public function getFacilityReservation($input)
    {
        return FacilityReservation::find($input);
    }
    public function addFacilityReservation($input)
    {
        $dateType = $input->date . " " . $input->hour;
        $date = Carbon::createFromFormat('Y-m-d H:i',  $dateType);
        if (Auth::user() instanceof Student) {
            $data = [
                'studentId' => Auth::user()->getAuthIdentifier(),
                'facilityId' => $input->facilityId,
                'academicalPersonalId' => null,
                'reservastionDate' => $date
            ];
        } else {
            $data = [
                'studentId' => null,
                'facilityId' => $input->facilityId,
                'academicalPersonalId' => Auth::user()->getAuthIdentifier(),
                'reservastionDate' => $date
            ];
        }
        $facilityReservation = new FacilityReservation($data);
        $result = $facilityReservation->save();
        return $result;
    }
    public function setFacilityReservation($input,$id)
    {
        $facilityReservation = FacilityReservation::find($id);

        if (!$facilityReservation instanceof FacilityReservation) {
            return $id . " id'li rezervasyon bulunamadı.";
        }

        $facilityReservation['facilityId'] = !empty($input->facilityId) ? $input->facilityId : $facilityReservation['facilityId'];

        $result = $facilityReservation->save();
        return $result;
    }
    public function deleteReservation($input)
    {
        $facilityReservation = FacilityReservation::find($input);

        if (!$facilityReservation instanceof FacilityReservation) {
            return $input . " id'li rezervasyon bulunamadı.";
        }

        $result = $facilityReservation->delete();
        return $result;
    }

    public function getReservationHour($input)
    {
        $facilityReservation = FacilityReservation::where('facilityId', 'LIKE', '%' . $input->facilityId . '%')->get();
        $hours = [];
        foreach ($facilityReservation as $reservation) {
            $hour['hour'] = Carbon::parse($reservation->reservastionDate)->format('H:i');
            array_push($hours,$hour);
        }
        return response()->json($hours, 200);
    }
}
