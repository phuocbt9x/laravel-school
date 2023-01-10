<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use App\Models\AttendanceModel;
use App\Models\ExamScheduleDetailModel;
use App\Models\ExamScheduleModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamScheduleDetailController extends Controller
{
    public function index()
    {
        $User =  Auth::user();
        $getIdUser = $User->getInfo->id;
        $getDepartment = $User->getInfo->Course->department->id;
        $getCourse = $User->getInfo->Course->id;
        //dd($getCourse);
        $examSchedule = ExamScheduleModel::where('department_id', $getDepartment)->get();
        $assignmentModel = AssignmentModel::where('course_id', $getCourse)->get();
        foreach($assignmentModel as $assignment){
            $attendance = AttendanceModel::where([
                ['assignment_id' , $assignment->id],
                ['student_id' , $getIdUser],
                ['check' , 0]
            ])->count();
            $arr [$assignment->subject_id] = [
                'diligence' => 10 - (2.5 * $attendance)
            ];
        }
        
        $examScheduleStudents = ExamScheduleDetailModel::where([
            ['student_id' , $getIdUser],
           
        ])->get();   
        //dd($arr);
        return view('examScheduleDetail.index', compact([
            'examScheduleStudents',
            'arr'
        ]));
    }

    public function indexAdmin()
    {
        $User =  Auth::user();
        $getIdUser = $User->getInfo->id;

        $examScheduleStudents = ExamScheduleDetailModel::get();

        return view('examScheduleDetail.indexAdmin', compact([
            'examScheduleStudents',
        ]));
    }
}
