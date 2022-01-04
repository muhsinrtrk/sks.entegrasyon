<?php

namespace App\Http\Controllers;

use App\Models\FacilityReservation;
use App\Service\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function getReservations(Request $request)
    {
        $reservationService = new ReservationService();
        $data = $reservationService->getFacilityReservations($request);
        return response($data, 200);
    }

    public function getReservation($id)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->getFacilityReservation($id);
        if (!$data instanceof FacilityReservation && $data == null) {
            return response()->json([
                'message' => $id . " id'li rezervasyon bulunamadı."
            ], 404);
        }
        return response($data, 200);
    }

    public function addReservation(Request $request)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->addFacilityReservation($request);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully add reservation!'
            ], 200);
        }elseif ($data == 'weekend') {
            return response()->json([
                'message' => 'Hafta Sonu!'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Failed to add reservation!'
            ], 500);
        }
    }

    public function setReservation(Request $request, $id)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->setFacilityReservation($request, $id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully updated reservation!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to update reservation!'
            ], 500);
        } else {
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function deleteReservation($id)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->deleteReservation($id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully deleted reservation!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to delete reservation!'
            ], 500);
        } else {
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function getReservationHour(Request $request)
    {
        $reservationService = new ReservationService();
        $result = $reservationService->getReservationHour($request);
        return $result;
    }
}
