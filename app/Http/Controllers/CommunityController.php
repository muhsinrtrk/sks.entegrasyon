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
        return response($data, 200);
    }

    public function getCommunity($id)
    {
        $communityService = new CommunityService();
        $data = $communityService->getCommunity($id);
        if (!$data instanceof Community) {
            return response()->json([
                'message' => $id . " id'li topluluk bulunamadı."
            ], 404);
        }
        return response($data, 200);
    }

    public function addCommunity(Request $request)
    {
        $communityService = new CommunityService();
        $data = $communityService->addCommunity($request);
        if ($data) {
            return response()->json([
                'message' => 'Successfully add community!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to add community!'
            ], 500);
        }
    }

    public function setCommunity(Request $request, $id)
    {
        $communityService = new CommunityService();
        $data = $communityService->setCommunity($request, $id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully updated community!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to update community!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function deleteCommunity($id)
    {
        $communityService = new CommunityService();
        $data = $communityService->deleteCommunity($id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully deleted community!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to delete community!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $data
            ], 404);
        }
    }
    public function joinCommunityByStudent(Request $request)
    {
        $communityService = new CommunityService();
        $result = $communityService->joinStudentCommunity($request);
        if ($result == 1) {
            return response()->json([
                'message' => 'Successfully join community!'
            ], 200);
        } elseif ($result == 0) {
            return response()->json([
                'message' => 'Failed to join community!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $result
            ], 404);
        }
    }
}
