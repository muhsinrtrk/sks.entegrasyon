<?php

namespace App\Http\Controllers;

use App\Models\Guesthouse;
use App\Service\GuesthouseService;
use Illuminate\Http\Request;

class GuesthouseController extends Controller
{
    public function getGuesthouses(Request $request)
    {
        $guesthouseService = new GuesthouseService();
        $data = $guesthouseService->getGuesthouses($request);
        return response($data, 200);
    }

    public function getGuesthouse($id)
    {
        $guesthouseService = new GuesthouseService();
        $data = $guesthouseService->getGuesthouse($id);
        if (!$data instanceof Guesthouse) {
            return response()->json([
                'message' => $id . " id'li tesis bulunamadı."
            ], 404);
        }
        return response($data, 200);
    }

    public function addGuesthouse(Request $request)
    {
        $guesthouseService = new GuesthouseService();
        $data = $guesthouseService->addGuesthouses($request);
        if ($data) {
            return response()->json([
                'message' => 'Successfully added guesthouse!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to add guesthouse!'
            ], 500);
        }
    }

    public function setGuesthouse(Request $request, $id)
    {
        $guesthouseService = new GuesthouseService();
        $data = $guesthouseService->setGuesthouses($request,$id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully updated guesthouse!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to update guesthouse!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $data
            ], 404);
        }
    }

    public function deleteGuesthouse($id)
    {
        $guesthouseService = new GuesthouseService();
        $data = $guesthouseService->deleteGuesthouses($id);
        if ($data == 1) {
            return response()->json([
                'message' => 'Successfully deleted guesthouse!'
            ], 200);
        } elseif ($data == 0) {
            return response()->json([
                'message' => 'Failed to delete guesthouse!'
            ], 500);
        }
        else{
            return response()->json([
                'message' => $data
            ], 404);
        }
    }
}
