<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest\StoreRequest;
use App\Http\Requests\ShiftRequest\UpdateRequest;
use App\Models\ShiftModel;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = ShiftModel::orderBy('time_start', 'ASC')->get();
        return view('shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shift.create');
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
            $shift = ShiftModel::create($request->all());
            if (!empty($shift)) {
                return redirect()->route('shift.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShiftModel  $shiftModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ShiftModel $shiftModel)
    {
        return view('shift.update', compact('shiftModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShiftModel  $shiftModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ShiftModel $shiftModel)
    {
        try {
            $shift = $shiftModel->update($request->all());
            if (!empty($shift)) {
                return redirect()->route('shift.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShiftModel  $shiftModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShiftModel $shiftModel)
    {
        $destroy = $shiftModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('shift.index')
            ]);
        }
    }
}
