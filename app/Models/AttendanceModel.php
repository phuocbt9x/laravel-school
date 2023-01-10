<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttendanceModel extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = [
        'assignment_id',
        'student_id',
        'check',
        'date'
    ];

    public function getAssignment()
    {
        return $this->hasOne(AssignmentModel::class,'id', 'assignment_id');
    }

    public function getStudent()
    {
        return $this->hasOne(StudentModel::class, 'id', 'student_id');
    }
}
