<?php

namespace App\Http\Requests\AssignmentRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // $course_id = request()->route()->assignmentModel->getCourseName->id;
        // $subject_id = request()->route()->assignmentModel->getSubject->id;
        // $teacher_id = request()->route()->assignmentModel->getTeacher->id;
        // $shift_id = request()->route()->assignmentModel->getShift->id;
        //dd($course_id , $subject_id, $teacher_id, $shift_id);
        return [
            'course_id' => 'required' ,
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'shift_id' => 'required',
            'date' => 'date'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'date' => 'Trường này cần đúng định dạng',
        ];
    }
}
