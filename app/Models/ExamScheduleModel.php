<?php

namespace App\Models;

use App\Enums\NumberOfMinutesEnum;
use App\Enums\TimeStartEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;
    protected $table = 'exam_schedules';
    protected $fillable  = [
        'subject_id' , 'department_id', 'teacher_id', 'type', 'date', 'timestart', 'minutes'
    ];

    public function ExamSheduleDetail()
    {
        return $this->belongsToMany(StudentModel::class, 'exam_schedule_details', 'exam_schedule_id', 'student_id', 'id', 'id');
    }

    public function getSubject()
    {
        return $this->hasOne(SubjectModel::class, 'id', 'subject_id');
    }

    public function getDepartment()
    {
        return $this->hasOne(DepartmentModel::class, 'id', 'teacher_id');
    }

    public function getTeacher()
    {
        return $this->hasOne(TeacherModel::class, 'id', 'teacher_id');
    }

    public function getTimeStart($object)
    {
        return TimeStartEnum::getKeyByValue($object);
    }

    public function getNumberOfMinutes($object)
    {
        return NumberOfMinutesEnum::getKeyByValue($object);
    }

    public function getType()
    {
        return  ($this->type == '0') ? 'Tự luận' : 'Thực hành';
    }

    public function stringDate()
    {
        $date = date('d/m/Y', strtotime($this->date));
        return $date;
    }
}
