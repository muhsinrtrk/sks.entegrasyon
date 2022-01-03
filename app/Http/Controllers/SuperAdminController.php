<?php

namespace App\Http\Controllers;

use App\Models\SuperAdmin;
use App\Service\AuthService;
use App\Service\SuperAdminService;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function superAdminSignUp(Request $request)
    {
        $authService = new SuperAdminService();
        $result = $authService->addSuperAdmin($request);
        return $result;
    }
}
