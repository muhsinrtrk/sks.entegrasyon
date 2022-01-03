<?php

namespace App\Service;


use App\Models\Community;
use App\Models\SksAdmin;
use App\Models\StudentHasCommunity;
use Illuminate\Support\Facades\Auth;

class SksAdminService
{
    public function getSksAdmins($input)
    {
        return SksAdmin::all();
    }

    public function getSksAdmin($input)
    {
        $data = SksAdmin::find($input);

        if (!$data instanceof SksAdmin) {
            return response()->json([
                'message' => $input . " id'li sks admin bulunamadı."
            ], 404);
        }
        return $data;

    }

    public function addSksAdmin($input)
    {
        $user = new SksAdmin([
            'name' => $input->name,
            'surname' => $input->surname,
            'email' => $input->email,
            'password' => bcrypt($input->password)
        ]);
        $user->save();

        return response()->json([
            'message' => 'Successfully created sks admin!'
        ], 201);
    }

    public function setSksAdmin($input, $id)
    {
        $user = SksAdmin::find($id);

        if (!$user instanceof SksAdmin) {
            return $id . " id'li sks admin bulunamadı.";
        }

        $user['name'] = !empty($input->name) ? $input->name : $user['name'];
        $user['surname'] = !is_null($input->surname) ? $input->surname : $user['surname'];
        $user['email'] = !is_null($input->email) ? $input->email : $user['email'];

        $result = $user->save();
        return $result;
    }

    public function deleteSksAdmin($input)
    {
        $user = SksAdmin::find($input);

        if (!$user instanceof SksAdmin) {
            return $input . " id'li sks admin bulunamadı.";
        }

        $result = $user->delete();
        return $result;
    }
}
