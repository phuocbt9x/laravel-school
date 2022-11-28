<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest\StoreRequest;
use App\Http\Requests\SubjectRequest\UpdateRequest;
use App\Models\SubjectModel;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = SubjectModel::orderBy('id', 'ASC')->get();
        return view('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
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
            $subject = SubjectModel::create($request->all());
            if (!empty($subject)) {
                return redirect()->route('subject.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectModel  $subjectModel
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectModel $subjectModel)
    {
        return view('subject.update', compact('subjectModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectModel  $subjectModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, SubjectModel $subjectModel)
    {
        try {
            $subject = $subjectModel->update($request->all());
            if (!empty($subject)) {
                return redirect()->route('subject.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectModel  $subjectModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectModel $subjectModel)
    {
        $destroy = $subjectModel->delete();
        if ($destroy) {
            return response()->json([
                'message' => 'Dữ liệu đã được xóa thành công!',
                'url' => route('subject.index')
            ]);
        }
    }
}
