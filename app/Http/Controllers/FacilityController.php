<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Service\FacilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FacilityController extends Controller
{
    public function getFacilities(Request $request)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->getFacilities($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ], 200);
    }

    public function getFacility($id)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->getFacility($id);
        if (!$data instanceof Facility) {
            return response()->json([
                'status' => false,
                'message' => $id . " id'li tesis bulunamadı.",
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
        return response($data, 200);
    }

    public function addFacility(Request $request)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->addFacility($request);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Tesis eklendi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tesis eklenemedi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        }
    }

    public function setFacility(Request $request, $id)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->setFacility($request, $id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Tesis güncellendi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Tesis güncellenemedi.',
                'errorCode' => '',
                'data' => ''
            ], 500);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tesis bulunamadı.',
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
    }

    public function deleteFacility($id)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->deleteFacility($id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Tesis silindi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => true,
                'message' => 'Tesis silinemedi.',
                'errorCode' => '',
                'data' => ''
            ], 500);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Tesis bulunamdı.',
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
    }
}
