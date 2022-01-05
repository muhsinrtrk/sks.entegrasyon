<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\Facility;
use App\Models\FacilityReservation;
use App\Models\SksAdmin;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    public function getFacilityReservations($input)
    {
        $result = FacilityReservation::all();
        $result = FilterService::filterReservation($result);
        foreach ($result as $key => $item) {
            if ($item->studentId == null) {
                $result->merge($item->AcademicalPersonal->get());
            } else {
                $result->merge($item->Student->get());
            }
        }
        return $result;
    }

    public function getFacilityReservation($input)
    {
        $result = FacilityReservation::find($input);
        $result = FilterService::filterReservation($result);
        foreach ($result as $item) {
            if ($input == $item->id) {
                return $item;
            }
        }
        return null;
    }

    public function addFacilityReservation($input)
    {
        $dateType = $input->date . " " . $input->hour;
        $date = Carbon::createFromFormat('Y-m-d H:i', $dateType);
        $day = Carbon::createFromFormat('Y-m-d H:i', $dateType)->format('l');
        if ($day == 'Saturday' || $day == 'Sunday') {
            return 'weekend';
        }
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

    public function setFacilityReservation($input, $id)
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
            array_push($hours, $hour);
        }
        return $hours;
    }
}
