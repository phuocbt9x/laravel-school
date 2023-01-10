<?php

namespace App\Http\Controllers;

use App\Enums\DayAssignmentEnum;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\StudentModel;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CalendarController extends Controller
{
    private  CourseModel $model;
    public function __construct()
    {
        $assignmentContent =AssignmentModel::query()->get();
        
        View::share('assignmentContent', $assignmentContent);
    }
    public function index()
    {
        $student = StudentModel::get();
        if(Auth::user()->level == 1 || Auth::user()->level == 2 ){ 
            $assignment = AssignmentModel::get();   
            dd($assignment);
            return   compact('assignment');
        }
        $course_infor =  StudentModel::where('id' ,Auth::user()->id )->orderBy('id' , 'ASC')->get();
        $assignment_infor = AssignmentModel::where('course_id' , $course_infor[0]->course_id)->orderBy('id' , 'ASC')->get();
        return   compact('assignment_infor');   
    }
    
    public function fecth($id)
    {
        $arr = [];
        if($id == 1 || $id == 2){
            $events = AssignmentModel::where('teacher_id', $id)->orderBy('id', 'ASC')->get(); 

            foreach($events as $event){
                $time_start = $event->date_start;
                $time_end = $event->date_end;
                $periods = CarbonPeriod::create($time_start, $time_end);
                foreach($event->SubjectDay() as $day){
                    foreach($periods as $period){
                        if($period->format('l') === $day){
                        
                                $arr[]= [
                                    'id'=> $event->id,
                                    'title' => $event->editTitleEvent(),
                                    'start' => $period->format('Y-m-d'),
                                    'url' => route('attendance.index' , [$event->id , $period->format('Y-m-d')])
                                ];
                            
                        }
                    }
                }
            }
            
            return response()->json($arr);
        }   
        $students = StudentModel::where('id', $id)->orderBy('id', 'ASC')->get();
        foreach($students as $student){
            $assignment_id = AssignmentModel::where('course_id', $student->course_id)->orderBy('id', 'ASC')->get(); 
            foreach($assignment_id as $event){
                $time_start = $event->date_start;
                $time_end = $event->date_end;
                $periods = CarbonPeriod::create($time_start, $time_end);
                foreach($event->SubjectDay() as $day){
                    foreach($periods as $period){
                        if($period->format('l') === $day){ 
                                $arr[]= [
                                    'id'=> $event->id,
                                    'title' => $event->editTitleEventStudent(),
                                    'start' => $period->format('Y-m-d'),
                                ];      
                        }
                    }
                }
            }
            return response()->json($arr);
        }
    }

     // $result = $events->groupBy(['subject_id', function ($item) {
        //     return DayAssignmentEnum::getKeyByValue($item['day']);
        // }], preserveKeys: true);
        
        // // $result = $result->all();
        // dd($result);

        // foreach ($result as  $dates) {
        //     foreach($dates as $day => $date){
        //         dd($date[0]->date_start);
        //     $period = CarbonPeriod::create('2022-01-01', '2022-12-30');
        //     echo $date->format('l');
        //     }
             
        // }
        
        // Convert the period to an array of dates
        // $dates = $period->toArray();

        // dd($dates);
        

        // if($events->isEmpty()){
        //    return response()->json($arr); 
        // }
        
        // foreach($events as $key => $value){
        //         $name = CourseModel::where('id' , $value->id)->value('name');
        //         $arr[]= [
        //            'id'=> $value->id,
        //             'title' => $name,
        //             'date_start' => $value->date_start,
        //             'date_end' => $value->date_end,
        //             'teacher_id' => $value->teacher_id,
        //             'course_id' => $value->course_id
        //         ];
        // }
        // dd($arr);
    public function create(Request $request)
    {
        $events = new AssignmentModel();
        $events->id = $request->title;
        $events->date = $request->eventDate;
    }
}
