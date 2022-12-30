<?php

namespace App\Http\Controllers;

use App\Models\ExamScheduleDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamScheduleDetailController extends Controller
{
    public function index()
    {
        $User =  Auth::user();
        $getIdUser = $User->getInfo->id;
        $examScheduleStudents = ExamScheduleDetailModel::where('student_id' , $getIdUser)->get();   
        return view('examScheduleDetail.index', compact('examScheduleStudents'));
    }
}
