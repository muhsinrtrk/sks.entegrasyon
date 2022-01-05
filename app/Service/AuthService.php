<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\SksAdmin;
use App\Models\Student;
use App\Models\SuperAdmin;
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
        return $user->save();
    }

    public function login($input)
    {
        $credentials = ['email' => $input->email, 'password' => $input->password];
        if (Auth::guard($input->role)->attempt($credentials)) {

            config(['auth.guards.api.provider' => $input->role]);

            $user = Auth::guard($input->role)->user();
            $success = $user;
            $success['token'] = $user->createToken('MyApp', [$input->role])->accessToken;
            return $success;
        } else {
            return false;
        }
    }
    public function logout($input)
    {
        return $input->user()->token()->revoke();
    }
}
