<?php

namespace App\Http\Controllers;

use App\Enums\DayAssignmentEnum;
use App\Http\Requests\AssignmentRequest\StoreRequest;
use App\Http\Requests\AssignmentRequest\UpdateRequest;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\ShiftModel;
use App\Models\SubjectDayModel;
use App\Models\SubjectModel;
use App\Models\SubjectTimeModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        
        
        $assignments = AssignmentModel::orderBy('id', 'ASC')->get();   
        return view('assignment.index', compact('assignments'));
    }

    public function create()
    {
        $arrDayAssignment = DayAssignmentEnum::getArrayValue();
        $courses = CourseModel::where('activated', 1)
            ->orderBy('name', 'ASC')
            ->get();
        $subjects = SubjectModel::where('activated', 1)
            ->orderBy('name', 'ASC')
            ->get();
        $teachers = TeacherModel::whereHas('getInfoLogin', function ($query) {
            return $query->where('activated', 1);
        })
            ->orderBy('id', 'ASC')
            ->get();
        $shifts = ShiftModel::where('activated', 1)
            ->orderBy('time_start', 'ASC')
            ->get();
        $Assignment = AssignmentModel::get();
        return view('assignment.create', [
            'courses' => $courses,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'shifts' => $shifts,
            'arrDayAssignment' => $arrDayAssignment,
            'Assignment' => $Assignment,
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $assignmentModel = new AssignmentModel();
            $assignment = $assignmentModel::create($request->except(['days_id', 'shifts_id']));

            foreach ($request->shifts_id as $shift) {
                $shifts[] = [
                    'assignment_id' => $assignment->id,
                    'shift_id' => $shift
                ];
            }

            foreach ($request->days_id as $day) {
                $days[] = [
                    'assignment_id' => $assignment->id,
                    'day_id' => $day
                ];
            }
            if ($assignment) {
                $subjectTimeModel = new SubjectTimeModel();
                $subjectTimeModel::insert($shifts);

                $subjectDayModel = new SubjectDayModel();
                $subjectDayModel::insert($days);
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
        $subjectDayModel = SubjectDayModel::where('assignment_id', $assignmentModel->id)->get();
        $subjectTimeModel = subjectTimeModel::where('assignment_id', $assignmentModel->id)->get();
        //dd($subjectDayModel, $subjectTimeModel);
        foreach($subjectDayModel as $subjectDay){
            $days[] = [
                'assignment_id' => $assignmentModel->id,
                'day_id' => $subjectDay->day_id,
            ];
        }
        foreach($subjectTimeModel as $subjectTime){
            $shiftsArr[] = [
                'assignment_id' => $assignmentModel->id,
                'shift_id' => $subjectTime->shift_id,
            ];
        }
        $arrDayAssignment = DayAssignmentEnum::getArrayValue();
        //dd($shifts);
        $Assignment = AssignmentModel::get();
        $courses = CourseModel::query()->get();
        $subjects = SubjectModel::query()->get();
        $teachers = TeacherModel::query()->get();
        $shifts = ShiftModel::query()->get();
        return view('assignment.update', compact(
            'assignmentModel',
            'courses',
            'subjects',
            'teachers',
            'shifts',
            'arrDayAssignment',
            'days',
            'shiftsArr'

        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseModel  $courseModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AssignmentModel $assignmentModel)
    {
        // dd($request);
        // dd($assignmentModel->getShifts()->update($request->shift_id));
        try {
            $assignment = $assignmentModel->update($request->except(['days_id', 'shifts_id']));
            //$assignment_id = $ass
            foreach ($request->shift_id as $shift) {
                //dd($shift);
                $shifts[] = [
                    'assignment_id' => $assignmentModel->id,
                    'shift_id' => $shift
                ];
            }

            foreach ($request->day_id as $day) {
                $days[] = [
                    'assignment_id' => $assignmentModel->id,
                    'day_id' => $day
                ];
            }
            
            //dd($shifts, $days);
            if (!empty($assignment)) {
                $index =  $assignmentModel->id;
                // $days->each(function ($item) {
                //     dd($item);
                //     SubjectDayModel::updateOrCreate([
                //         ['assignment_id' => $item['assignment_id']],
                //         ['day_id' => $item['day_id']]
                //     ]);
                // });
                // $shifts->each(function ($item) {
                    
                //     SubjectTimeModel::updateOrCreate([
                //         ['assignment_id' => $item['assignment_id']],
                //         ['shift_id' => $item['shift_id']]
                //     ]);
                // });
                $subjectDayModelDelete = SubjectDayModel::where('assignment_id' , $assignmentModel->id)->delete();
                $subjectTimeModelDelete = SubjectTimeModel::where('assignment_id' , $assignmentModel->id)->delete();
                if($subjectDayModelDelete){
                    $subjectDayModel = SubjectDayModel::upsert($days,['assignment_id'], ['day_id']);       
                }
                if($subjectDayModelDelete){
                    $subjectTimeModel = SubjectTimeModel::upsert($shifts,['assignment_id'], ['shift_id']);
                }
                
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
