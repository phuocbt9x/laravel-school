<?php

namespace App\Http\Controllers;

use App\Enums\NumberOfMinutesEnum;
use App\Enums\TimeStartEnum;
use App\Http\Requests\ExamScheduleRequest\StoreRequest;
use App\Http\Requests\ExamScheduleRequest\UpdateRequest;
use App\Models\AssignmentModel;
use App\Models\DepartmentModel;
use App\Models\ExamScheduleDetailModel;
use App\Models\ExamScheduleModel;
use App\Models\ShiftModel;
use App\Models\StudentModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
use App\Models\TimeStartModel;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamScheduleController extends Controller
{
    public function index()
    {
        $User =  Auth::user();
        $checkUser = $User->level;
        $getIdUser = $User->getInfo->id;
        // $arr = [];
        // $examSchedule = ExamScheduleModel::get();
        // foreach($examSchedule as $examScheduleTeacher){
        //     $courseInfor = $examScheduleTeacher->getDepartment->getCourses;
        //     foreach($courseInfor as $course){
        //         $student = StudentModel::where('course_id', $course->id )->value('id');
                
        //         $arr []= [
        //             'exam_schedule_id' => $examScheduleTeacher->id, 
        //             'student_id' => $student,
        //             'activated' => 1,
        //             //'course' => $course->id,
        //         ];
        //     }
        // }
        // //dd($arr);
        // foreach($arr as $data_examSchedule){

        //     $examSchedule = ExamScheduleDetailModel::create($data_examSchedule);
        // }
        if($checkUser === '1'){
            $examScheduleTeacher = ExamScheduleModel::get();
        }
        else if($checkUser === '2'){
            $examScheduleTeacher = ExamScheduleModel::where('teacher_id' , $getIdUser)->get();
        }
        
        return view('examSchedule.index', compact('examScheduleTeacher'));
    }

    public function create(Request $request)
    {
        
        $timeStarts = TimeStartEnum::getArrayValue();
        $minutes = NumberOfMinutesEnum::getArrayValue();
        $subjects = SubjectModel::where('activated', 1)->orderBy('name', 'ASC')->get();
        $teachers = TeacherModel::whereHas('getInfoLogin', function ($query) {
            return $query->where('activated', 1);
        })->orderBy('id', 'ASC')->get();
        $departments = DepartmentModel::where('activated', 1)->orderBy('name', 'ASC')->get();
        return view('examSchedule.create' ,compact(
            'subjects',
            'teachers',
            'departments',
            'timeStarts',
            'minutes'
        ));
    }

    public function store(StoreRequest $request)
    {
        $assignments = AssignmentModel::all();
        try { 
            foreach($assignments as $assignment){
                if( $request->get('department_id') == $assignment->getCourseName->department->id  && $request->get('subject_id') == $assignment->subject_id ){
                    $selectExamSchedule = ExamScheduleModel::where([
                        'subject_id' => $request->get('subject_id'),
                        'department_id' => $request->get('department_id'),
                        'teacher_id' => $request->get('teacher_id'),
                        'date' => $request->get('date')
                    ])->get();
                    if($selectExamSchedule->all() !== []){
                        return redirect()->back()->with('error', 'Lịch thi này đã tồn tại');
                    }  
                    $examSchedule = ExamScheduleModel::create($request->all()); 
                    $ExSchedule = ExamScheduleModel::get();
                    foreach($ExSchedule as $examScheduleStudent){
                        $courseInfor = $examScheduleStudent->getDepartment->getCourses;
                        foreach($courseInfor as $course){
                            $student = StudentModel::where('course_id', $course->id )->value('id');
                            ExamScheduleDetailModel::updateOrCreate(
                                [
                                    'exam_schedule_id' => $examScheduleStudent->id,
                                    'student_id' => $student,
                                    'activated' => 1
                                ],
                            );
                        }
                    }
                    if (!empty($examSchedule)) {   
                        return redirect()->route('examSchedule.index')
                            ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
                    }
                }
            }
            return redirect()->back()->with('error', 'Khoa này chưa có lịch học');
        } catch (\Throwable $th) {
            dd('Lỗi');
        }
    }

    public function edit(ExamScheduleModel $examScheduleModel)
    {
        $timeStarts = TimeStartEnum::getArrayValue();
        $minutes = NumberOfMinutesEnum::getArrayValue();
        $subjects = SubjectModel::where('activated', 1)->orderBy('name', 'ASC')->get();
        $teachers = TeacherModel::whereHas('getInfoLogin', function ($query) {
            return $query->where('activated', 1);
        })->orderBy('id', 'ASC')->get();
        $departments = DepartmentModel::where('activated', 1)->orderBy('name', 'ASC')->get();
        return view('examSchedule.update', compact(
            'examScheduleModel',
            'teachers',
            'departments',
            'timeStarts',
            'minutes',
            'subjects',
        ));
    }

    public function update(UpdateRequest $request, ExamScheduleModel $examScheduleModel )
    {
        try {
            $examSchedule = $examScheduleModel->update($request->all());
            
            if (!empty($examSchedule)) {
                return redirect()->route('examSchedule.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function destroy(ExamScheduleModel $examScheduleModel)
    {
        $destroyExamDetail = ExamScheduleDetailModel::where('exam_schedule_id' , $examScheduleModel->id)->delete();
        $destroy = $examScheduleModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('examSchedule.index')
            ]);
        }
    }
}
