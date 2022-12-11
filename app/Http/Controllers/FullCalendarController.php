<?php

namespace App\Http\Controllers;

use App\Models\AssignmentModel;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index()
    {
        $assinment = AssignmentModel::get('id');
        
        return  view('homepage', compact('assinment'));
    }

    public function fecth()
    {
        $events = AssignmentModel::select('id', 'date')->get();
        dd($events);
        return response()->json($events);
    }
}
