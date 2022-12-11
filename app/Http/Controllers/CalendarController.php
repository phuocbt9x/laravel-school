<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use App\Models\CourseModel;
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
        
        $n = new AssignmentModel();
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
        return response()->json($arr);
    }

    public function create(Request $request)
    {
        $events = new AssignmentModel();
        $events->id = $request->title;
        $events->date = $request->eventDate;
    }
}
