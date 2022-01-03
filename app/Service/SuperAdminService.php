<?php

namespace App\Service;



use App\Models\SksAdmin;
use App\Models\SuperAdmin;


class SuperAdminService
{
    public function getSuperAdmins($input)
    {
        return SuperAdmin::all();
    }

    public function getSuperAdmin($input)
    {
        $data = SuperAdmin::find($input);

        if (!$data instanceof SuperAdmin) {
            return response()->json([
                'message' => $input . " id'li super admin bulunamadı."
            ], 404);
        }
        return $data;

    }

    public function addSuperAdmin($input)
    {
        $user = new SuperAdmin([
            'name' => $input->name,
            'surname' => $input->surname,
            'email' => $input->email,
            'password' => bcrypt($input->password)
        ]);
        $user->save();

        return response()->json([
            'message' => 'Successfully created super admin!'
        ], 201);
    }

    public function setSuperAdmin($input, $id)
    {
        $user = SuperAdmin::find($id);

        if (!$user instanceof SuperAdmin) {
            return $id . " id'li super admin bulunamadı.";
        }

        $user['name'] = !empty($input->name) ? $input->name : $user['name'];
        $user['surname'] = !is_null($input->surname) ? $input->surname : $user['surname'];
        $user['email'] = !is_null($input->email) ? $input->email : $user['email'];

        $result = $user->save();
        return $result;
    }

    public function deleteSuperAdmin($input)
    {
        $user = SuperAdmin::find($input);

        if (!$user instanceof SuperAdmin) {
            return $input . " id'li super admin bulunamadı.";
        }

        $result = $user->delete();
        return $result;
    }
}
