<?php

namespace App\Http\Controllers;

use App\Models\SksAdmin;
use App\Service\AuthService;
use App\Service\SksAdminService;
use Illuminate\Http\Request;

class SksAdminController extends Controller
{
    public function getSksAdmins(Request $request)
    {
        $communityService = new SksAdminService();
        $data = $communityService->getSksAdmins($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ],200);
    }

    public function getSksAdmin($id)
    {
        $communityService = new SksAdminService();
        $data = $communityService->getSksAdmin($id);
        if (!$data instanceof SksAdmin) {
            return response()->json([
                'status' => false,
                'message' => $id . " id'li sks admin bulunamadı.",
                'errorCode' => '',
                'data' => ''
            ],404);
        }
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ],200);
    }

    public function addSksAdmin(Request $request)
    {
        $communityService = new SksAdminService();
        $data = $communityService->addSksAdmin($request);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Sks Admini eklendi',
                'errorCode' => '',
                'data' => ''
            ],200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sks Admini eklenemedi',
                'errorCode' => '',
                'data' => ''
            ],200);
        }
    }

    public function setSksAdmin(Request $request, $id)
    {
        $communityService = new SksAdminService();
        $data = $communityService->setSksAdmin($request, $id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Sks Admini güncellendi.',
                'errorCode' => '',
                'data' => ''
            ],200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Sks Admini güncellenemedi.',
                'errorCode' => '',
                'data' => ''
            ],200);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => $data,
                'errorCode' => '',
                'data' => ''
            ],404);
        }
    }

    public function deleteSksAdmin($id)
    {
        $communityService = new SksAdminService();
        $data = $communityService->deleteSksAdmin($id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Sks Admini silindi.',
                'errorCode' => '',
                'data' => ''
            ],200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => 'Sks admini silinemedi.',
                'errorCode' => '',
                'data' => ''
            ],200);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => $data,
                'errorCode' => '',
                'data' => ''
            ],404);
        }
    }
}
