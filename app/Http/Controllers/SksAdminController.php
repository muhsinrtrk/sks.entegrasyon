<?php

namespace App\Http\Controllers;

use App\Service\AuthService;
use App\Service\SksAdminService;
use Illuminate\Http\Request;

class SksAdminController extends Controller
{
    public function getSksAdmins(Request $request)
    {
        $communityService = new SksAdminService();
        $data = $communityService->getSksAdmins($request);
        return response($data, 200);
    }

    public function getSksAdmin($id)
    {
        $communityService = new SksAdminService();
        $data = $communityService->getSksAdmin($id);
        return response($data, 200);
    }

    public function addSksAdmin(Request $request)
    {
        $communityService = new SksAdminService();
        $data = $communityService->addSksAdmin($request);
        if ($data) {
            return response()->json([
                'message' => 'Successfully add sks admin!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to add sks admin!'
            ], 500);
        }
    }

    public function setSksAdmin(Request $request, $id)
    {
        $communityService = new SksAdminService();
        $data = $communityService->setSksAdmin($request, $id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully updated sks admin!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to update sks admin!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function deleteSksAdmin($id)
    {
        $communityService = new SksAdminService();
        $data = $communityService->deleteSksAdmin($id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully deleted sks admin!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to delete sks admin!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $data
            ], 404);
        }
    }
}
