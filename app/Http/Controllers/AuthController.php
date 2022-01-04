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
        return $result;
    }
    public function logout(Request $request){
        $authService = new AuthService();
        $result = $authService->logout($request);
        if ($result == 1){
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }else{
            return response()->json([
                'message' => 'Fail logged out'
            ]);
        }

    }
}
