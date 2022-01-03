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
        return response($data, 200);
    }

    public function getFacility($id)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->getFacility($id);
        if (!$data instanceof Facility) {
            return response()->json([
                'message' => $id . " id'li tesis bulunamadı."
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
                'message' => 'Successfully add facility!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to add facility!'
            ], 500);
        }
    }

    public function setFacility(Request $request, $id)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->setFacility($request, $id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully updated facility!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to update facility!'
            ], 500);
        } else {
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function deleteFacility($id)
    {
        $facilityService = new FacilityService();
        $data = $facilityService->deleteFacility($id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully deleted facility!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to delete facility!'
            ], 500);
        } else {
            return response()->json([
                'message' => $data
            ], 404);
        }
    }
}
