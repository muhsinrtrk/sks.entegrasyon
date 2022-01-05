<?php

namespace App\Http\Controllers;

use App\Models\AcademicalPersonal;
use App\Models\Student;
use App\Models\SuperAdmin;
use App\Models\User;
use App\Service\AuthService;
use Illuminate\Http\Request;
use App\Models\SksAdmin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $authService = new AuthService();
        $result = $authService->login($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => [$result]
        ], 200);
    }
    public function logout(Request $request){
        $authService = new AuthService();
        $result = $authService->logout($request);
        if ($result == 1){
            return response()->json([
                'status' => true,
                'message' => 'Çıkış yapıldı.',
                'errorCode' => '',
                'data' => []
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Çıkış yapılamadı.',
                'errorCode' => '',
                'data' => []
            ], 500);
        }

    }
}
