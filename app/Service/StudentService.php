<?php

namespace App\Service;


use App\Models\AcademicalPersonal;
use App\Models\Community;
use App\Models\SksAdmin;
use App\Models\Student;
use App\Models\StudentHasCommunity;
use Illuminate\Support\Facades\Auth;

class StudentService
{
    public function getStudents($input)
    {
        return Student::all();
    }

    public function getStudent($input)
    {
        $data = Student::find($input);
        return $data;
    }
}
