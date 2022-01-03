<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'presidentStudentId',
        'academicalPersonalId',
    ];

    public function PresidentStudent(){
        return $this->hasOne(Student::class,'presidentStudentId','id');
    }
    public function AcademicalPersonal(){
        return $this->hasOne(AcademicalPersonal::class,'academicalPersonalId','id');
    }
    public function StudentHasCommunity(){
        return $this->hasMany(StudentHasCommunity::class,'communityId','id');
    }
}
