<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorRequest\StoreRequest;
use App\Http\Requests\MajorRequest\UpdateRequest;
use App\Models\DepartmentModel;
use App\Models\MajorModel;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = MajorModel::orderBy('id', 'ASC')->get();
        return view('major.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = DepartmentModel::where('activated', 1)->orderBy('id', 'ASC')->get();
        return view('major.create', compact('departments'));
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
            $major = MajorModel::create($request->all());
            if (!empty($major)) {
                return redirect()->route('major.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MajorModel  $majorModel
     * @return \Illuminate\Http\Response
     */
    public function edit(MajorModel $majorModel)
    {
        $departments = DepartmentModel::where('activated', 1)->orderBy('id', 'ASC')->get();
        return view('major.update', compact('departments', 'majorModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MajorModel  $majorModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, MajorModel $majorModel)
    {
        try {
            $major = $majorModel->update($request->all());
            if (!empty($major)) {
                return redirect()->route('major.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MajorModel  $majorModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MajorModel $majorModel)
    {
        $destroy = $majorModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('major.index')
            ]);
        }
    }
}
