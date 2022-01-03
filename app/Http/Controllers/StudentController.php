<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\StudentHasCommunity;
use App\Service\AuthService;
use App\Service\CommunityService;
use App\Service\ReservationService;
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
}
