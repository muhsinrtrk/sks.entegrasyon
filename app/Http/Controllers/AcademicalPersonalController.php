<?php

namespace App\Http\Controllers;

use App\Models\AcademicalPersonal;
use App\Service\AcademicalPersonalService;
use App\Service\AuthService;
use App\Service\ReservationService;
use Illuminate\Http\Request;

class AcademicalPersonalController extends Controller
{
    public function getAcademicalPersonals(Request $request)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->getAcademicalPersonals($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => [$data]
        ], 200);
    }

    public function getAcademicalPersonal($id)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->getAcademicalPersonal($id);
        if (!$data instanceof AcademicalPersonal) {
            return response()->json([
                'status' => true,
                'message' => $id . " id'li personal bulunamadı.",
                'errorCode' => '',
                'data' => []
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => '',
            'errorCode' => '',
            'data' => [$data]
        ], 200);
    }

    public function addAcademicalPersonal(Request $request)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->addAcademicalPersonal($request);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Personel eklendi.',
                'errorCode' => '',
                'data' => []
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Personel eklenemedi.',
                'errorCode' => '',
                'data' => []
            ], 500);
        }
    }

    public function setAcademicalPersonal(Request $request, $id)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->setAcademicalPersonal($request, $id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Personel güncellendi.',
                'errorCode' => '',
                'data' => []
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Personel güncellenemedi.',
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

    public function deleteAcademicalPersonal($id)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->deleteAcademicalPersonal($id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Personel silindi.',
                'errorCode' => '',
                'data' => []
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => true,
                'message' => 'Personel silinemedi.',
                'errorCode' => '',
                'data' => []
            ], 500);
        } else {
            return response()->json([
                'status' => true,
                'message' => $data,
                'errorCode' => '',
                'data' => []
            ], 404);
        }
    }
}
