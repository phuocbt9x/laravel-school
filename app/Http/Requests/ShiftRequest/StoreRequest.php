<?php

namespace App\Http\Requests\ShiftRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:150|unique:shifts',
            'slug' => 'sometimes',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
            'activated' => 'sometimes'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Trường này quá ngắn!',
            'max' => 'Trường này vượt quá giới hạn!',
            'unique' => 'Trường này đã tồn tại!',
            'after' => 'Trường này phải kết thúc sau thời gian bắt đầu!'
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->title)
        ]);
    }
}
