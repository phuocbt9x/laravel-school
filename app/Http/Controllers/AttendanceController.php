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
        $assignments = AssignmentModel::find($id);
        $course_name =  $assignments->getCourseName->name;
        $subject_name =  $assignments->getSubject->name;
        $arr = [];
        $course_id = $assignments->course_id;
        $Student_lists = CourseModel::find($course_id)->getStudent;
        $assignmentCheck = AttendanceModel::where('assignment_id', $id)->get();
        foreach ($assignments->AttendanceCheck as $student) {

            $arr[] = [
                'id' => $student->id,
                'name' => $student->fullname,
                'birthdate' => $student->birthdate,
                'check' => $student->pivot->check,
            ];
        }
        if (!$assignmentCheck->isNotEmpty()) {
            foreach ($Student_lists as $Student_list) {
                $arr[] = [
                    'id' => $Student_list->id,
                    'birthdate' => $Student_list->birthdate,
                    'name' => $Student_list->fullname,
                    'check' => '',
                ];
            }
        }
        return view('attendance.index', compact([
            'assignments',
            'course_name',
            'subject_name',
            'arr',
            'date'
        ]));
    }

    public function attendance(Request $request)
    {
        $assignment_id = $request->assignment_id;
        $attendanceArray = AttendanceModel::where('assignment_id', $assignment_id)->get();
        $students = $request->item;
        if (!$attendanceArray->isNotEmpty()) {
            foreach ($students as $id => $student) {
                AttendanceModel::create(
                    [
                        'assignment_id' => $assignment_id,
                        'student_id' => $id,
                        'check' => $student,
                    ]
                );
            }
        } else {
            foreach ($students as $id => $student) {
                $attendanceModel = AttendanceModel::where([
                    ['assignment_id', $assignment_id],
                    ['student_id', $id],
                ])->first();

                $attendanceModel->update(
                    [
                        'check' => $student,
                    ]
                );
            }
        }
        return redirect()->back();
    }
}
