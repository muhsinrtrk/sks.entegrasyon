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
        return response($data, 200);
    }

    public function getAcademicalPersonal($id)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->getAcademicalPersonal($id);
        if (!$data instanceof AcademicalPersonal) {
            return response()->json([
                'message' => $id . " id'li personal bulunamadı."
            ], 404);
        }
        return response($data, 200);
    }

    public function addAcademicalPersonal(Request $request)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->addAcademicalPersonal($request);
        if ($data) {
            return response()->json([
                'message' => 'Successfully add personal!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to add personal!'
            ], 500);
        }
    }

    public function setAcademicalPersonal(Request $request, $id)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->setAcademicalPersonal($request, $id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully updated personal!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to update personal!'
            ], 500);
        } else {
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function deleteAcademicalPersonal($id)
    {
        $academicalPersonal = new AcademicalPersonalService();
        $data = $academicalPersonal->deleteAcademicalPersonal($id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully deleted personal!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to delete personal!'
            ], 500);
        } else {
            return response()->json([
                'message' => $data
            ], 404);
        }
    }
}
