<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use App\Models\AttendanceModel;
use App\Models\CourseModel;
use App\Models\ShiftModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class AttendanceController extends Controller
{

    public function index($id, $date = null)
    {
        $date = $date;
        //dd($date);
        $assignments = AssignmentModel::find($id);
        $course_name =  $assignments->getCourseName->name;
        $subject_name =  $assignments->getSubject->name;
        $arr = [];
        $course_id = $assignments->course_id;
        $Student_lists = CourseModel::find($course_id)->getStudent;
        $assignmentCheck = AttendanceModel::where([
            ['assignment_id', $id],
            ['date' , $date]
        ])->get();
        if (!$assignmentCheck->isNotEmpty()) {
            foreach ($Student_lists as $Student_list) {
                $arr[$id][ $Student_list->id] = [ 
                    'check' => '',
                    'date' => $date
                ];
            }
        }
        else{
            foreach ($assignmentCheck as $student) {
                //dd($student);
                $arr[$id][$student->student_id] = [
                    'check' => $student->check,
                    'date' => $student->date
                ];
            }
        }
        //dd($arr[$id][$assignmentCheck[0]->student_id]['check']);
        
        $list_student = $assignments->AttendanceCheck;
        //dd($Student_lists);
        return view('attendance.index', compact([
            'assignments',
            'course_name',
            'subject_name',
            'arr',
            'date',
            'list_student',
            'Student_lists'
        ]));
    }

    public function attendance(Request $request)
    {
        $assignment_id = $request->assignment_id;
        $date = $request->date;
        //dd($request);
        $attendanceArray = AttendanceModel::where([
            ['assignment_id', $assignment_id],
            ['date' , $date]
        ])->get();
        $students = $request->item;
        //dd($students);
        
        if (!$attendanceArray->isNotEmpty()) {
            //dd($date);
            foreach ($students as $id => $student) {
                AttendanceModel::create(
                    [
                        'assignment_id' => $assignment_id,
                        'student_id' => $id,
                        'check' => $student,
                        'date' => $date,
                    ]
                );
            }
           // dd(1);
        } else {
            //dd(2);
            foreach ($students as $id => $student) {
                $attendanceModel = AttendanceModel::updateOrCreate([
                    'assignment_id'=> $assignment_id,
                    'student_id'=> $id,
                    'date' => $date,
                ],[
                    'check' => $student,
                ]
                );
            }
        }
        return redirect()->back();
    }
}
