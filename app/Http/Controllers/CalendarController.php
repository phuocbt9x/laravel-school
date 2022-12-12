<?php

namespace App\Http\Controllers;

use App\Enums\DayAssignmentEnum;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
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
        $assignment = AssignmentModel::get();
       
        return   compact('assignment');
    }

    public function fecth($id)
    {
        $arr = [];
        $events = AssignmentModel::where('teacher_id', $id)->orderBy('id', 'ASC')->get(); 
        // $group = $events->groupBy(function ($item, $key) {
        //     return DayAssignmentEnum::getKeyByValue($item['day']);
        // });
        $result = $events->groupBy(['subject_id', function ($item) {
            return DayAssignmentEnum::getKeyByValue($item['day']);
        }], preserveKeys: true);
        
        // $result = $result->all();
        dd($result);
        //dd($arrDayAssignment);
        // Iterate over the period
        foreach ($result as  $dates) {
            foreach($dates as $day => $date){
                dd($date[0]->date_start);
            $period = CarbonPeriod::create('2022-01-01', '2022-12-30');
            echo $date->format('l');
            }
             
        }

        // Convert the period to an array of dates
        $dates = $period->toArray();

        dd($dates);
        

        if($events->isEmpty()){
           return response()->json($arr); 
        }
        
        foreach($events as $key => $value){
                $name = CourseModel::where('id' , $value->id)->value('name');
                $arr[]= [
                   'id'=> $value->id,
                    'title' => $name,
                    'date_start' => $value->date_start,
                    'date_end' => $value->date_end,
                    'teacher_id' => $value->teacher_id,
                    'course_id' => $value->course_id
                ];
        }
        dd($arr);
        return response()->json($arr);
    }

    public function create(Request $request)
    {
        $events = new AssignmentModel();
        $events->id = $request->title;
        $events->date = $request->eventDate;
    }
}
