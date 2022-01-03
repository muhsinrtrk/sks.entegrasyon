<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\Community;
use App\Models\SksAdmin;
use App\Models\StudentHasCommunity;
use Illuminate\Support\Facades\Auth;

class AcademicalPersonalService
{
    public function getAcademicalPersonals($input)
    {
        return AcademicalPersonal::all();
    }

    public function getAcademicalPersonal($input)
    {
        $data = AcademicalPersonal::find($input);

        if (!$data instanceof AcademicalPersonal) {
            return response()->json([
                'message' => $input . " id'li personal bulunamadı."
            ], 404);
        }
        return $data;

    }

    public function addAcademicalPersonal($input)
    {
        $user = new AcademicalPersonal([
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

    public function setAcademicalPersonal($input, $id)
    {
        $user = AcademicalPersonal::find($id);

        if (!$user instanceof AcademicalPersonal) {
            return $id . " id'li personal bulunamadı.";
        }

        $user['name'] = !empty($input->name) ? $input->name : $user['name'];
        $user['surname'] = !is_null($input->surname) ? $input->surname : $user['surname'];
        $user['email'] = !is_null($input->email) ? $input->email : $user['email'];

        $result = $user->save();
        return $result;
    }

    public function deleteAcademicalPersonal($input)
    {
        $user = AcademicalPersonal::find($input);

        if (!$user instanceof AcademicalPersonal) {
            return $input . " id'li personal bulunamadı.";
        }

        $result = $user->delete();
        return $result;
    }
}
