<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    protected $fillable = [
        'fullname', 'gender', 'birthdate', 'login_id', 'avatar',
        'phone', 'address', 'city_id', 'district_id', 'ward_id'
    ];

    public function getInfoLogin()
    {
        return $this->hasOne(LoginModel::class, 'id', 'login_id');
    }

    public function stringGender()
    {
        switch ($this->gender) {
            case '1':
                $gender = '<span class="badge badge-pill bg-gradient-info">Nam</span>';
                break;

            default:
                $gender = '<span class="badge badge-pill bg-gradient-info">Nữ</span>';
                break;
        }

        return $gender;
    }

    public function stringBirthDate()
    {
        $birthdate = date('d/m/Y', strtotime($this->birthdate));
        return $birthdate;
    }

    public function level()
    {
        switch ($this->getInfoLogin->level) {
            case '1':
                $level = '<span class="badge badge-pill bg-gradient-primary">Giáo vụ</span>';
                break;

            default:
                $level = '<span class="badge badge-pill bg-gradient-primary">Giảng viên</span>';
                break;
        }

        return $level;
    }

    public function status()
    {
        switch ($this->getInfoLogin->activated) {
            case '1':
                $status = '<span class="badge badge-pill bg-gradient-success">Kích hoạt</span>';
                break;

            default:
                $status = '<span class="badge badge-pill bg-gradient-danger">Ẩn</span>';
                break;
        }

        return $status;
    }

    public function stringPhone()
    {
        $phone = substr($this->phone, 0, 4) .
            '.' . substr($this->phone, 4, 3) .
            '.' . substr($this->phone, 7);
        return $phone;
    }
}
