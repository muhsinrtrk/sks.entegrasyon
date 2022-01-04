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
        return $result;
    }
    public function getStudents(Request $request)
    {
        $student = new StudentService();
        $data = $student->getStudents($request);
        return response($data, 200);
    }
    public function getStudent($id)
    {
        $student = new StudentService();
        $data = $student->getStudent($id);
        if (!$data instanceof Student) {
            return response()->json([
                'message' => $id . " id'li öğrenci bulunamadı."
            ], 404);
        }
        return response($data, 200);
    }
}
