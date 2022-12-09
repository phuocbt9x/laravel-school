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
    public function index()
    {
        $assignments = AssignmentModel::get();
        return view('attendance.index', compact(['assignments']));
    }
    public function post(Request $request)
    {
        
        // $assignments = AssignmentModel::get();
        // $subject_id = $request->get('assignment_subject');
        // $course_id = $request->get('assignment_course');
        
        // $students = StudentModel::query()->where('course_id' , $course_id)->get();        
        // $teacher_id = Auth::user()->getInfo->id;
        // $shifts = AssignmentModel::query()->where([
        //     ['course_id' ,'=' , $course_id],
        //     ['subject_id','=', $subject_id],
        //     ['teacher_id', '=', $teacher_id]       
        // ])->get(); 
       
        // $assignmentId = AssignmentModel::query()
        //     ->where('course_id' , $course_id)
        //     ->where('subject_id', $subject_id)
        //     ->orderByDesc('shift_id')
        //     ->value('id');
        // $arrAttendance = [];
        
        // if(!empty($assignmentId)){
        //     $attendanceStudents = AttendanceModel::
        //     select([
        //         'student_id',
        //         'check'    
        //     ])
        //     ->where('assignment_id', $assignmentId)
        //     ->get();
        //     foreach($attendanceStudents as $attendanceStudent){
        //         $arrAttendance[$attendanceStudent->student_id] = $attendanceStudent->check;
        //     }
        // }
        // dd($request);
        // return view('attendance.index', compact([
        //     'students', 
        //     'assignments',
        //     'arrAttendance'
        // ]));
        $arr = [];
        $Student_lists = CourseModel::find($request->assignment_course)->getStudent;
        foreach($Student_lists as $Student_list){
            
                foreach($Student_list->AttendanceCheck as $student){
                    $arr = [
                        'id' => $student->pivot->pivotParent->id,
                        'name' => $student->pivot->pivotParent->fullname,
                        'check' => $student->pivot->check,
                        'assignment_id' => $student->pivot->assignment_id
                    ];
                    
                }   
        }
        return $arr;

    }
    
    public function attendance(Request $request)
    {
        $course_id = $request->get('course_id');
        $subject_id = $request->get('subject_id');
        $teacher_id = Auth::user()->getInfo->id;
        $checks = $request->get('arrAttendance');
        $assignment = AssignmentModel::query()->where([
            ['subject_id','=', $subject_id,],
            ['course_id' ,'=' , $course_id],
            ['teacher_id', '=', $teacher_id]       
        ])->value('id'); 
        
        $name=[];
        
        $created_at = AttendanceModel::select('created_at')->where([['assignment_id', $assignment]])->value('date');
        $updated_at = AttendanceModel::select('updated_at')->where([['assignment_id', $assignment]])->get();
        // dd(date_format($created_at[0]->created_at, "Y-m") === date("Y-m"));
        // dd( date('Y-m', strtotime(($assignment))) );
        
        // dd($courseId, $subjectId,$checks, $teacher_id , $assignment[0]->id);
        if(isset($created_at)){
            
            if(date_format($created_at, "Y-m") === date("Y-m")){
                foreach ($checks as $student => $check) {
                    AttendanceModel::query()->update([
                        'assignment_id' => $assignment,
                        'student_id' => $student,
                        'check' => $check
                    ]);
                }
            }
        }
        else{
            foreach ($checks as $student => $check) {
                AttendanceModel::create([
                    'assignment_id' => $assignment,
                    'student_id' => $student,
                    'check' => $check
                ]);
            }
        }
        

        $course_name = CourseModel::where('id' , $course_id)->value('name');
        $subject_name = SubjectModel::where('id' , $subject_id)->value('name');
        // dd($course_name);
        return redirect()->route('attendance.index',  [
            'course_id' => $course_id ,
            'course_name' => $course_name,
            'subject_id' => $subject_id,
            'subject_name' => $subject_name
        ]);
    }
}
