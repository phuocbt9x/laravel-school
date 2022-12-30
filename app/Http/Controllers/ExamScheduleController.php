<?php

namespace App\Http\Controllers;

use App\Enums\NumberOfMinutesEnum;
use App\Enums\TimeStartEnum;
use App\Http\Requests\ExamScheduleRequest\StoreRequest;
use App\Http\Requests\ExamScheduleRequest\UpdateRequest;
use App\Models\DepartmentModel;
use App\Models\ExamScheduleModel;
use App\Models\ShiftModel;
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
        $checkUser = Auth::user()->level;
        $getIdUser = Auth::user()->getInfo->id;
        if($checkUser === '1'){
            $examScheduleTeacher = ExamScheduleModel::get();
        }
        else{
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
        
        try {
            $examScheduleModel = new ExamScheduleModel();
            $examSchedule = $examScheduleModel::create($request->all());
            if (!empty($examSchedule)) {
                return redirect()->route('examSchedule.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
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
        $destroy = $examScheduleModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('examSchedule.index')
            ]);
        }
    }
}
