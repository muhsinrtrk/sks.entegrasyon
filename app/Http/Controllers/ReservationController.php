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
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ], 200);
    }

    public function getReservation($id)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->getFacilityReservation($id);
        if (!$data instanceof FacilityReservation && $data == null) {
            return response()->json([
                'status' => true,
                'message' => $id . " id'li rezervasyon bulunamadı.",
                'errorCode' => '',
                'data' => []
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ], 200);
    }

    public function addReservation(Request $request)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->addFacilityReservation($request);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Rezervasyon eklendi.',
                'errorCode' => '',
                'data' => []
            ], 200);
        }elseif ($data == 'weekend') {
            return response()->json([
                'status' => false,
                'message' => 'Hafta sonu rezervasyon yapılamaz.',
                'errorCode' => '',
                'data' => []
            ], 404);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bilinmeyen hata.',
                'errorCode' => '',
                'data' => []
            ], 500);
        }
    }

    public function setReservation(Request $request, $id)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->setFacilityReservation($request, $id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Rezervasyon güncellendi.',
                'errorCode' => '',
                'data' => []
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Rezervasyon güncellenemedi.',
                'errorCode' => '',
                'data' => []
            ], 500);
        } else {
            return response()->json([
                'status' => false,
                'message' => $data,
                'errorCode' => '',
                'data' => []
            ], 404);
        }
    }

    public function deleteReservation($id)
    {
        $facilityService = new ReservationService();
        $data = $facilityService->deleteReservation($id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Rezervasyon silindi.',
                'errorCode' => '',
                'data' => []
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Rezervasyon silinemedi.',
                'errorCode' => '',
                'data' => []
            ], 500);
        } else {
            return response()->json([
                'status' => false,
                'message' => $data,
                'errorCode' => '',
                'data' => []
            ], 404);
        }
    }

    public function getReservationHour(Request $request)
    {
        $reservationService = new ReservationService();
        $result = $reservationService->getReservationHour($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $result
        ], 200);
    }
}
