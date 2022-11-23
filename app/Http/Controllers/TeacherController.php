<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest\StoreRequest;
use App\Http\Requests\TeacherRequest\UpdateRequest;
use App\Models\LoginModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teachers = TeacherModel::orderBy('id', 'ASC')->get();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
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

                $dataTeacher = $request->except(['email', 'password', 'activated']);
                
                if ($request->hasFile('avatar')) {
                    $avatar = $request->avatar;
                    $nameAvatar = $avatar->getClientOriginalName();
                    $dirFolder = 'uploads/avatar/teacher/';
                    $newAvatar = $dirFolder . 'teacher-' . $login->id . '-' . $nameAvatar;
                    $dataTeacher['avatar'] = $newAvatar;
                }

                $teacher = TeacherModel::create($dataTeacher);
                
                if (!empty($teacher)) {
                    $avatar->move($dirFolder, $newAvatar);
                    return redirect()->route('teacher.index')
                        ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
                }
                $login->delete();
                return redirect()->route('teacher.index')
                ->withErrors(['error' => 'Thêm mới dữ liệu thất bại']);
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
    public function show(TeacherModel $teacherModel)
    {
        return view('teacher.detail', compact('teacherModel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherModel  $teacherModel
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherModel $teacherModel)
    {
        return view('teacher.update', compact('teacherModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeacherModel  $teacherModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, TeacherModel $teacherModel)
    {

        try {
            $loginModel = LoginModel::find($teacherModel->login_id);
            $login = $loginModel->update($request->only(['email', 'password', 'level', 'activated']));
            if (!empty($login)) {
                $dataTeacher = $request->except(['email', 'password', 'activated']);

                if ($request->hasFile('avatar')) {
                    $avatar = $request->avatar;
                    $nameAvatar = $avatar->getClientOriginalName();
                    $dirFolder = 'uploads/avatar/teacher/';
                    $newAvatar = $dirFolder . 'teacher-' . $loginModel->id . '-' . $nameAvatar;
                    $dataTeacher['avatar'] = $newAvatar;
                    @unlink($teacherModel->avatar);
                }
                $teacher = $teacherModel->update($dataTeacher);
                if (!empty($teacher)) {
                    if (!empty($avatar)) {
                        $avatar->move($dirFolder, $newAvatar);
                    }
                    return redirect()->route('teacher.index')
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
     * @param  \App\Models\TeacherModel  $teacherModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherModel $teacherModel)
    {
        $avatar = $teacherModel->avatar;
        $destroy = $teacherModel->delete();
        if ($destroy) {
            @unlink($avatar);
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('teacher.index')
            ]);
        }
    }
}
