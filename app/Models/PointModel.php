<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointModel extends Model
{
    use HasFactory;
    protected $table = 'points';
    protected $fillable = [
        'assignment_id', 'student_id', 'diligence', 'mid_term', 'final', 'total', 'activated'
    ];

    public function getStudent()
    {
        return $this->hasOne(StudentModel::class, 'id', 'student_id');
    }

    public function getAssignment()
    {
        return $this->hasOne(AssignmentModel::class, 'id', 'assignment_id');
    }

    public function getStudentName($object):array
    {   
        dd($object);
        $student = StudentModel::where('id',$object)->value('fullname');
        return $student;
    }

    public function getRank()
    {
        if((($this->total >=1 ) && ($this->total < 3)) || $this->total == []){
            $total =  'F';
        }
        else if(($this->total >=3 ) && ($this->total < 4)){
            $total = 'D';
        }
        else if(($this->total >=4 ) && ($this->total < 6)){
            $total = 'C';
        }
        else if(($this->total >=6 ) && ($this->total < 8)){
            $total = 'B';
        }
        else if(($this->total >=6 ) && ($this->total < 8)){
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
}
