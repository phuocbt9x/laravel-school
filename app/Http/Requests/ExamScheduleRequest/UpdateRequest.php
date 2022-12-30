<?php

namespace App\Http\Requests\ExamScheduleRequest;

use App\Enums\NumberOfMinutesEnum;
use App\Enums\TimeStartEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'subject_id' => 'required',
            'department_id' => 'required',
            'teacher_id' => 'required',
            'type' => 'required',
            'date' => 'required|date',
            'timestart' => [
                'required',
                Rule::in(TimeStartEnum::asArray()),
            ],
            'minutes' => [
                'required',
                Rule::in(NumberOfMinutesEnum::asArray()),
            ]
        ];
    }

    public function messages():array
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'date' => 'Trường này không đúng kiểu dữ liệu!'
        ];
    }
}
