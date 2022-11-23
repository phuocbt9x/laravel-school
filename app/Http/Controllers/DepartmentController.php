<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest\StoreRequest;
use App\Http\Requests\DepartmentRequest\UpdateRequest;
use App\Models\DepartmentModel;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = DepartmentModel::orderBy('id', 'ASC')->get();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
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
            $department = DepartmentModel::create($request->all());
            if (!empty($department)) {
                return redirect()->route('department.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentModel $departmentModel)
    {
        return view('department.update', compact('departmentModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, DepartmentModel $departmentModel)
    {
        try {
            $department = $departmentModel->update($request->all());
            if (!empty($department)) {
                return redirect()->route('department.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentModel  $departmentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentModel $departmentModel)
    {
        $destroy = $departmentModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('department.index')
            ]);
        }
    }
}
