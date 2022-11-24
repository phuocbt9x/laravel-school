<?php

namespace App\Http\Requests\CourseRequest;

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
            'name' => 'required|min:3|max:150|unique:courses',
            'department_id' => 'required',
            'slug' => 'sometimes',
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
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }
}
