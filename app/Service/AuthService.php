<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\SksAdmin;
use App\Models\Student;
use App\Models\SuperAdmin;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthService
{
    public function studentSignUp($input)
    {
        $user = new Student([
            'name' => $input->name,
            'surname' => $input->surname,
            'studentNumber' => $input->studentNumber,
            'email' => $input->email,
            'password' => bcrypt($input->password)
        ]);
        $user->save();

        return response()->json([
            'message' => 'Successfully created student!'
        ], 201);
    }

    public function login($input)
    {
        $credentials = ['email' => $input->email, 'password' => $input->password];
        if (Auth::guard($input->role)->attempt($credentials)) {

            config(['auth.guards.api.provider' => $input->role]);

            $user = Auth::guard($input->role)->user();
            $success = $user;
            $success['token'] = $user->createToken('MyApp', [$input->role])->accessToken;
            return response()->json($success, 200);
        } else {
            return response()->json(['error' => ['Email and Password are Wrong.']], 404);
        }
    }
    public function logout($input)
    {
        return $input->user()->token()->revoke();
    }
}
