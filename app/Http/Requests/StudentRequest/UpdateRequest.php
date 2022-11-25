<?php

namespace App\Http\Requests\StudentRequest;

use App\Rules\Phone;
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
     * @return array
     */
    public function rules()
    {
        $id_login = request()->route()->studentModel->login_id;
        $id = request()->route()->studentModel->id;
        return [
            'fullname' => 'required|min:3|max:150',
            'gender' => 'required|boolean',
            'birthdate' => 'required|date|before:today',
            'level' => 'required',
            'avatar' => 'image',
            'phone' => ['required', new Phone('Số điện thoại không đúng định dạng!'), 'unique:students,phone,' . $id],
            'course_id' => 'required',
            'email' => 'required|email|unique:logins,email,' . $id_login,            
            'address' => 'sometimes',
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'activated' => 'sometimes',
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Trường này không được bỏ trống!',
            'min' => 'Trường này quá ngắn!',
            'max' => 'Trường này vượt quá giới hạn!',
            'date' => 'Trường này không đúng kiểu dữ liệu!',
            'before' => 'Trường này phải trước ngày hiện tại!',
            'date' => 'Trường này không đúng kiểu dữ liệu!',
            'email' => 'Trường này không đúng kiểu dữ liệu!',
            'unique' => 'Trường này đã tồn tại!',
            'confirmed' => 'Password nhập lại không đúng!'
        ];
    }

    protected function passedValidation()
    {
        if (!$this->filled('activated')) {
            $this->merge([
                'activated' => 0
            ]);
        }
        if ($this->filled('password')) {
            $this->merge([
                'password' => bcrypt(request('password'))
            ]);
        } else {
            $this->offsetUnset('password');
        }
        $this->offsetUnset('password_confirmation');
    }
}
