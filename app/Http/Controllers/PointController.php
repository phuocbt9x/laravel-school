<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointRequest\StoreRequest;
use App\Http\Requests\PointRequest\UpdateRequest;
use App\Models\AssignmentModel;
use App\Models\AttendanceModel;
use App\Models\CourseModel;
use App\Models\PointModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function index()
    {
        $teacher_id = Auth::user()->getInfo->id;
        $assignmentModel = AssignmentModel::where('teacher_id', $teacher_id)->get();
        return view('point.index', compact('assignmentModel'));
    }

    public function create( $id)
    {
        $assignmentModel = AssignmentModel::find($id);
        $course_id = $assignmentModel->course_id;
        $course_name = $assignmentModel->getCourseName->name;
        $subject_name = $assignmentModel->getSubject->name;
        $arr = [];
        $Student_lists = CourseModel::find($course_id)->getStudent;
        $pointModel = PointModel::where('assignment_id', $id)->get();
        if ($pointModel->isNotEmpty()) {
            foreach($assignmentModel->Point as $point){
                $listPoint[
                    $point->pivot->assignment_id
                ][
                    $point->pivot->student_id
                ] =[
                    'diligence' => $point->pivot->diligence,
                    'mid_term' => $point->pivot->mid_term,
                    'final' => $point->pivot->final,
                    'total' => $point->pivot->total,
                ];
            }
        }
        else{
            foreach($Student_lists as $student){
                $diligence[$id][$student->id] = [
                    'diligence' => 0,
                    'mid_term' => 0,
                    'final' => 0,
                    'total' => 0,
                ];   
            }
            $listPoint = $diligence;
        }
        $list = $assignmentModel->getCourseName->getStudent;
        return view('point.create', compact([
            'course_name',
            'arr',
            'id',
            'subject_name',
            'list',
            'listPoint',
            'pointModel'
        ]));
    }

    public function createPoint( $id, $student_id)
    {
        $pointModel = PointModel::where([
            ['assignment_id' , $id],
            ['student_id', $student_id] 
        ])->get()->all();
        if(!empty($pointModel)){
            return redirect()->back();
        }
        $student = StudentModel::find($student_id);
        $assignment = AssignmentModel::find($id);
        $course_id = $assignment->course_id;
        $course = CourseModel::find($assignment->course_id);
        $subject = SubjectModel::find($assignment->subject_id);
        $Student_lists = CourseModel::find($course_id)->getStudent;
        //dd($students);
        
        //dd($students['id']);    
        $diligencePoint = AttendanceModel::where([
            ['assignment_id', $id],
            ['student_id', $student_id],
            ['check' , 0],
        ])->count();
        $diligence=  10 - (2.5 * $diligencePoint);
        return view('point.createPoint', compact([
            'id',
            'student_id',
            'student',
            'course',
            'subject',
            'diligence'
        ]));
    }
    
    public function store(StoreRequest $request, $id, $student_id)
    {
        try {
            //dd($request->get('diligence'));
            if($request['diligence'] < 5){
                $request['final'] = 0;
                $total = 0;
            }
            else{
                $total = ($request['diligence']*0.2 + $request['mid_term']*0.4 + $request['final']*0.4)  ; 
            }

            //dd($total);
            $arr = [
                'assignment_id' => $id,
                'student_id' => $student_id,
                'diligence' => $request['diligence'],
                'mid_term' => $request['mid_term'],
                'final' => $request['final'],
                'total' => $total,
                'activated' => 1
            ];
            //dd($arr);
            $datapoint = PointModel::create($arr);
            return redirect()->route('point.create', $id);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function edit($id,$student_id)
    {
        $student = StudentModel::find($student_id);
        $pointModel = PointModel::where([
            ['assignment_id' , $id],
            ['student_id', $student_id] 
        ])->get()->all();
        if(empty($pointModel)){
            return redirect()->back();
        }
        $assignment = AssignmentModel::find($id);
        $course_id = $assignment->course_id;
        $course = CourseModel::find($assignment->course_id);
        $subject = SubjectModel::find($assignment->subject_id);
        //dd($pointModel);
        return view('point.update', compact([
            'student',
            'pointModel',
            'course_id',
            'course',
            'subject',
            'id',
            'student_id'
        ]));
    }

    public function update(UpdateRequest $request, PointModel $pointModel)
    {
        try {
            if($request->diligence < 5){
                $request['final']  = 0;
                $total = 0;
            }
            else{
                $total = ($request['diligence']*0.2 + $request['mid_term']*0.4 + $request['final']*0.4)  ;
            }
            $arr = [
                'assignment_id' => (string)$pointModel['assignment_id'],
                'student_id' => (string)$pointModel['student_id'],
                'diligence' => $request['diligence'],
                'mid_term' => $request['mid_term'],
                'final' => $request['final'],
                'total' => (string)$total,
                'activated' => 1
            ];
            $id = $pointModel['assignment_id'];
            $datapoint = $pointModel->update($arr);
            return redirect()->route('point.create', compact('id'));
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
