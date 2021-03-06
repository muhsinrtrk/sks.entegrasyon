<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Service\CommunityService;
use App\Service\FilterService;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function getCommunities(Request $request)
    {
        $communityService = new CommunityService();
        $data = $communityService->getCommunities($request);
        $data = FilterService::filterCommunity($data);
        json_encode($data);
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
                'message' => $id . " id'li topluluk bulunamad─▒.",
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
                'message' => 'Topluluk eklendi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Topluluk eklenemedi.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        }
    }

    public function setCommunity(Request $request, $id)
    {
        $communityService = new CommunityService();
        $data = $communityService->setCommunity($request, $id);
        if ($data == 1) {
            return response()->json([
                'status' => true,
                'message' => $id . " id'li topluluk g├╝ncellendi.",
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'status' => false,
                'message' => $id . " id'li topluluk g├╝ncellenemedi.",
                'errorCode' => '',
                'data' => ''
            ], 200);
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
                'message' => $id . " id'li topluluk g├╝ncellenemedi.",
                'errorCode' => '',
                'data' => ''
            ], 200);
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
                'message' => 'Toplulu─ča kat─▒ld─▒n.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        } elseif ($result == 0) {
            return response()->json([
                'status' => true,
                'message' => 'Toplulu─ča kat─▒lamad─▒n.',
                'errorCode' => '',
                'data' => ''
            ], 200);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => $result,
                'errorCode' => '',
                'data' => ''
            ], 404);
        }
    }
}
