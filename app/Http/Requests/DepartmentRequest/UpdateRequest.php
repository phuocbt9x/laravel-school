<?php

namespace App\Http\Requests\DepartmentRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
        $id = request()->route()->departmentModel->id;
        return [
            'name' => 'required|min:3|max:150|unique:departments,name,' . $id,
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

        if (!$this->filled('activated')) {
            $this->merge([
                'activated' => 0
            ]);
        }
    }
}
