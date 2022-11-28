<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest\StoreRequest;
use App\Http\Requests\CourseRequest\UpdateRequest;
use App\Models\CourseModel;
use App\Models\DepartmentModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = CourseModel::orderBy('id', 'ASC')->get();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = DepartmentModel::where('activated', 1)->orderBy('id', 'ASC')->get();
        return view('course.create', compact('departments'));
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
            $course = CourseModel::create($request->all());
            if (!empty($course)) {
                return redirect()->route('course.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherModel  $teacherModel
     * @return \Illuminate\Http\Response
     */
    public function show(CourseModel $courseModel)
    {
        return view('course.detail', compact('courseModel'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseModel  $courseModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseModel $courseModel)
    {
        $departments = DepartmentModel::where('activated', 1)->orderBy('id', 'ASC')->get();
        return view('course.update', compact('departments', 'courseModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseModel  $courseModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CourseModel $courseModel)
    {
        try {
            $course = $courseModel->update($request->all());
            if (!empty($course)) {
                return redirect()->route('course.index')
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
    public function destroy(CourseModel $courseModel)
    {
        $destroy = $courseModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('course.index')
            ]);
        }
    }
}
