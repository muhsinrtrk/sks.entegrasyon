<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Service\CommunityService;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function getCommunities(Request $request)
    {
        $communityService = new CommunityService();
        $data = $communityService->getCommunities($request);
        return response()->json([
            'status' => true,
            'message' => '',
            'errorCode' => '',
            'data' => $data
        ], 200);
    }

    public function getCommunity($id)
    {
        $communityService = new CommunityService();
        $data = $communityService->getCommunity($id);
        if (!$data instanceof Community) {
            return response()->json([
                'status' => false,
                'message' => $id . " id'li topluluk bulunamadı.",
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

    public function addCommunity(Request $request)
    {
        $communityService = new CommunityService();
        $data = $communityService->addCommunity($request);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Topluluk eklenedi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Topluluk eklenemedi.',
                'errorCode' => '',
                'data' => ''
            ], 500);
        }
    }

    public function setCommunity(Request $request, $id)
    {
        $communityService = new CommunityService();
        $data = $communityService->setCommunity($request, $id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => $id . " id'li topluluk bulunamadı.",
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => $id . " id'li topluluk güncellenemedi.",
                'errorCode' => '',
                'data' => ''
            ], 500);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => $data,
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
    }

    public function deleteCommunity($id)
    {
        $communityService = new CommunityService();
        $data = $communityService->deleteCommunity($id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => $id . " id'li topluluk silindi.",
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => $id . " id'li topluluk güncellenemedi.",
                'errorCode' => '',
                'data' => ''
            ], 500);
        }
        else{
            return response()->json([
                'status' => false,
                'message' => $data,
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
    }
    public function joinCommunityByStudent(Request $request)
    {
        $communityService = new CommunityService();
        $result = $communityService->joinStudentCommunity($request);
        if ($result == 1) {
            return response()->json([
                'status' => true,
                'message' => 'Topluluğa katıldın.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($result == 0) {
            return response()->json([
                'status' => true,
                'message' => 'Topluluğa katılamadın.',
                'errorCode' => '',
                'data' => ''
            ], 500);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => $result,
                'errorCode' => '',
                'data' => ''
            ], 500);
        }
    }
}
