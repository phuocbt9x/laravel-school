<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use App\Models\PointModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointStudentController extends Controller
{
    public function index()
    {
        $user = Auth::user()->getInfo;
        $listpoint = PointModel::where('student_id',$user->id)->get();
        $assignment_empty = AssignmentModel::where('course_id' , $user->course_id)->get();
        //dd($assignment_empty);
        if($listpoint->isNotEmpty()){
            //dd(2);
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
            //dd(1);
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
       // dd($point);
        if(!$assignment_empty->isNotEmpty()){
            $assignment_empty = [];
        }
        
        return view('pointStudent.index', compact([
            'point',
            'listpoint',
            'assignment_empty'
        ]));
    }
}
