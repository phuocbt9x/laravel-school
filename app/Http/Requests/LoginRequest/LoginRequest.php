<?php

namespace App\Http\Requests\LoginRequest;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:4',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'email' => 'Trường này không đúng định dạng email',
            'min' => 'Trường này quá ngắn',
        ];
    }


}
