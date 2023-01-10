<?php

namespace App\Models;

use App\Enums\DayAssignmentEnum;
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

    public function Point()
    {
        return $this->belongsToMany(StudentModel::class, 'points', 'assignment_id', 'student_id', 'id', 'id')->withPivot('diligence', 'mid_term', 'final', 'total');
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

    public function editTitleEvent()
    {
        $title = "Ca";
        $course = ($this->getCourseName()->first()->name);
        foreach($this->getShifts()->get() as $shift ){
            
            $title .= ' ' . substr($shift->title , -1);
        }
        
        return $course . ' - ' . $title;
    }

    public function editTitleEventStudent()
    {
        $title = "Ca";
        $subject = ($this->getSubject()->first()->name);
        foreach($this->getShifts()->get() as $shift ){
            
            $title .= ' ' . substr($shift->title , -1 );
        }
        
        return $subject . ' - ' . $title;
    }
    

    public function SubjectDay()
    {
        $arr = [];
        $days =  $this->hasMany(SubjectDayModel::class , 'assignment_id' , 'id')->get();
        foreach($days as $day){
            array_push( $arr,
                DayAssignmentEnum::getKeyByValue($day->day_id))
            ;
            
        }
        
        return $arr;
    }

    public function getRank($object)
    {
        if((($object >=1 ) && ($object < 3)) || empty($object)){
            $total =  'F';
        }
        else if(($object >=3 ) && ($object < 4)){
            $total = 'D';
        }
        else if(($object >=4 ) && ($object < 6)){
            $total = 'C';
        }
        else if(($object >=6 ) && ($object < 8)){
            $total = 'B';
        }
        else if(($object >=8 ) && ($object <= 10)){
            $total = 'A';
        }
        return $total;
    }

    public function checkFinalPoint($object)
    {
        if($object == 0){
            return 'Học lại';
        }
    }

    public function getDate()
    {
        $date = date('d/m/Y', strtotime($this->date));
        return $date;
    }
}
