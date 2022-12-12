<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentModel extends Model
{
    use HasFactory;
    protected $table = 'assignments';
    protected $fillable = [
        'course_id', 'subject_id', 'teacher_id', 'date_start', 'date_end'
    ];
    protected $day = [2, 3, 4, 5, 6, 7, 8];

    public function getAttedances()
    {
        return $this->hasMany(AttendanceModel::class, 'assignment_id', 'id');
    }

    public function AttendanceCheck()
    {
        return $this->belongsToMany(StudentModel::class, 'attendances', 'assignment_id', 'student_id', 'id', 'id')->withPivot('check');
    }

    public function getCourseName()
    {
        return $this->hasOne(CourseModel::class, 'id', 'course_id');
    }

    public function getSubject()
    {
        return $this->hasOne(SubjectModel::class, 'id', 'subject_id');
    }

    public function getTeacher()
    {
        return $this->hasOne(TeacherModel::class, 'id', 'teacher_id');
    }

    public function getShifts()
    {
        return $this->belongsToMany(ShiftModel::class, 'subject_times', 'assignment_id', 'shift_id', 'id', 'id');
    }

    public function getDate()
    {
        $date = date('d/m/Y', strtotime($this->date));
        return $date;
    }
}
