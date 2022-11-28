<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentModel extends Model
{
    use HasFactory;
    protected $table = 'assignments';
    protected $fillable = [
        'course_id' , 'subject_id' , 'teacher_id' , 'shift_id' , 'date'
    ];

    

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
    public function getShift()
    {
        return $this->hasOne(ShiftModel::class,  'id', 'shift_id');
    }
    
    public function getDate()
    {
        $date = date('d/m/Y', strtotime($this->date));
        return $date;
    }


}
