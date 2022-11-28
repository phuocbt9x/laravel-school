<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest\StoreRequest;
use App\Http\Requests\AssignmentRequest\UpdateRequest;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\ShiftModel;
use App\Models\SubjectModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $assignments = AssignmentModel::orderBy('id', 'ASC')->get();
        return view('assignment.index' , compact('assignments'));
    }

    public function create()
    {
        $courses = CourseModel::query()->get();
        $subjects = SubjectModel::query()->get();
        $teachers = TeacherModel::query()->get();
        $shifts = ShiftModel::query()->get();
        return view('assignment.create' ,[
            'courses' => $courses, 
            'subjects' => $subjects, 
            'teachers' => $teachers,
            'shifts' => $shifts
        ]);
    }

    public function store(StoreRequest $request)
    {   
       
        try {
            $assignment = AssignmentModel::create($request->all());
            if (!empty($assignment)) {
                return redirect()->route('assignment.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
    public function show()
    {
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseModel  $courseModel
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentModel $assignmentModel)
    {
        $courses = CourseModel::query()->get();
        $subjects = SubjectModel::query()->get();
        $teachers = TeacherModel::query()->get();
        $shifts = ShiftModel::query()->get();   
        return view('assignment.update' , compact(
            'assignmentModel' ,
            'courses',
        'subjects',
        'teachers',
        'shifts',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseModel  $courseModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request , AssignmentModel $assignmentModel)
    {
        try {
            $assignment = $assignmentModel->update($request->all());
            if (!empty($assignment)) {
                return redirect()->route('assignment.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseModel  $courseModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentModel $assignmentModel)
    {
        $destroy = $assignmentModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('assignment.index')
            ]);
        }
    }
}
