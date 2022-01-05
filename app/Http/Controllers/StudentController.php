<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Student;
use App\Models\StudentHasCommunity;
use App\Service\AuthService;
use App\Service\CommunityService;
use App\Service\ReservationService;
use App\Service\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function studentSignUp(Request $request)
    {
        $authService = new AuthService();
        $result = $authService->studentSignUp($request);
        if ($result == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Kayıt edilemedi.',
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Kayıt edildi.',
            'errorCode' => '',
            'data' => ''
        ], 200);
    }

    public function getStudents(Request $request)
    {
        $student = new StudentService();
        $data = $student->getStudents($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ], 200);
    }

    public function getStudent($id)
    {
        $student = new StudentService();
        $data = $student->getStudent($id);
        if (!$data instanceof Student) {
            return response()->json([
                'status' => true,
                'message' => $id . " id'li öğrenci bulunamadı.",
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ], 200);
    }
}
