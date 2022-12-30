<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleDetailModel extends Model
{
    use HasFactory;

    protected $table = 'exam_schedules';
    protected $fillable  = [
        'subject_id' , 'department_id', 'teacher_id', 'type', 'date', 'timestart', 'minutes'
    ];

    
}
