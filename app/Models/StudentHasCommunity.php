<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHasCommunity extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'communityId'
    ];

    public function Student(){
        return $this->belongsTo(Student::class,'studentId');
    }
    public function Community(){
        return $this->belongsTo(Community::class,'communityId');
    }
}
