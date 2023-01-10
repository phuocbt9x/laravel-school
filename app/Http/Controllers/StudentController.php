<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest\StoreRequest;
use App\Http\Requests\StudentRequest\UpdateRequest;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\LoginModel;
use App\Models\PointModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = StudentModel::orderBy('id', 'ASC')->get();
        return view('student.index', compact('students'));
    }

    public function create(CourseModel $courseModel)
    {
        return view('student.create', compact('courseModel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $login = LoginModel::create($request->only(['email', 'password', 'level', 'activated']));
            if (!empty($login)) {
                $request->merge([
                    'login_id' => $login->id
                ]);

                $datastudent = $request->except(['email', 'password', 'activated']);

                if ($request->hasFile('avatar')) {
                    $avatar = $request->avatar;
                    $nameAvatar = $avatar->getClientOriginalName();
                    $dirFolder = 'uploads/avatar/student/';
                    $newAvatar = $dirFolder . 'student-' . $login->id . '-' . $nameAvatar;
                    $datastudent['avatar'] = $newAvatar;
                }

                $student = StudentModel::create($datastudent);

                if (!empty($student)) {
                    $avatar->move($dirFolder, $newAvatar);
                    return redirect()->route('student.index')
                        ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
                }
                $login->delete();
                return redirect()->route('student.index')
                    ->withErrors(['error' => 'Thêm mới dữ liệu thất bại']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentModel  $StudentModel
     * @return \Illuminate\Http\Response
     */
    public function show(StudentModel $studentModel)
    {
        $listpoint = PointModel::where('student_id',$studentModel->id)->get();
        $assignment_empty = AssignmentModel::where('course_id' , $studentModel->course_id)->get();
        // dd($listpoint);
        if($listpoint->isNotEmpty()){
            foreach($listpoint as $list){
                $assignments = AssignmentModel::where('id' , $list->assignment_id)->get();
                //dd($assignments);
                foreach($assignments as $assignment){
                    $point[$assignment->id] = [
                        'diligence' => $list->diligence,
                        'mid_term' => $list->mid_term,
                        'final' => $list->final,
                        'total' => $list->total,
                    ];
                }
                
            }
        }
        else{
            if($assignment_empty->isNotEmpty()){
                foreach($assignment_empty as $assignment){
                    $point[$assignment->id] = [
                        'diligence' => 0,
                        'mid_term' => 0,
                        'final' => 0,
                        'total' => 0,
                    ];
                }
            }
            else{
                $point = [];
            }
        }
        //dd($point_assignment);
        if(!$assignment_empty->isNotEmpty()){
            $assignment_empty = [];
        }
        
        return view('student.detail', compact([
            'studentModel',
            'point',
            'listpoint',
            'assignment_empty'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentModel  $StudentModel
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentModel $studentModel)
    {
        $courses = CourseModel::get();
        return view('student.update', compact('studentModel', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentModel  $StudentModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, StudentModel $studentModel)
    {
        try {
            $loginModel = LoginModel::find($studentModel->login_id);
            $login = $loginModel->update($request->only(['email', 'password', 'level', 'activated']));
            if (!empty($login)) {
                $dataStudent = $request->except(['email', 'password', 'activated']);
                if ($request->hasFile('avatar')) {
                    $avatar = $request->avatar;
                    $nameAvatar = $avatar->getClientOriginalName();
                    $dirFolder = 'uploads/avatar/student/';
                    $newAvatar = $dirFolder . 'student-' . $loginModel->id . '-' . $nameAvatar;
                    $dataStudent['avatar'] = $newAvatar;
                    @unlink($studentModel->avatar);
                }
                $student = $studentModel->update($dataStudent);
                if (!empty($student)) {
                    if (!empty($avatar)) {
                        $avatar->move($dirFolder, $newAvatar);
                    }
                    return redirect()->route('student.index')
                        ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentModel  $StudentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentModel $studentModel)
    {
        $avatar = $studentModel->avatar;
        $destroy = $studentModel->delete();
        if ($destroy) {
            @unlink($avatar);
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('student.index')
            ]);
        }
    }
}
