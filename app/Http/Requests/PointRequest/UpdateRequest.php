<?php

namespace App\Http\Requests\PointRequest;

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
        return [
            'diligence' =>  'required',
            'mid_term' => 'required|numeric|min_digits:1|max:10',
            'final' => 'required|numeric|min_digits:1|max:10',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được để trống!',
            'numeric' => 'Trường này không đúng kiểu dữ liệu!',
            'min_digits' => 'Trường này phải lớn hơn 0 ',
            'max' => 'Trường này tối đa là 10 ',
        ];
    }
}
