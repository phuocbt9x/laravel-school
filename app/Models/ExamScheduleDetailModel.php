<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleDetailModel extends Model
{
    use HasFactory;

    protected $table = 'exam_schedule_details';
    protected $fillable  = [
        'exam_schedule_id', 'student_id','activated'
    ];

    public function getExamSchedule()
    {
        return $this->hasOne(ExamScheduleModel::class, 'id', 'exam_schedule_id');
    }

    public function getStudent()
    {
        return $this->hasOne(StudentModel::class, 'id', 'student_id');
    }
    
    public function checkBan($object)
    {
        if($object < 5){
            return 'Cấm thi';
        }
    }
}
