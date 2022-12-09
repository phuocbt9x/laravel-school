<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'fullname', 'gender', 'birthdate', 'login_id', 'avatar',
        'phone', 'course_id', 'address', 'city_id', 'district_id', 'ward_id'
    ];

    public function getInfoLogin()
    {
        return $this->belongsTo(LoginModel::class, 'login_id');
    }

    public function Course()
    {
        return $this->hasOne(CourseModel::class, 'id', 'course_id');
    }

    public function AttendanceCheck()
    {
        return $this->belongsToMany(AssignmentModel::class,'attendances', 'student_id', 'assignment_id' , 'id','id')->withPivot('check');
    }

    public function getCourseName()
    {
        return $this->Course->name;
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
            case '3':
                $level = '<span class="badge badge-pill bg-gradient-primary">Sinh viên</span>';
                break;

            default:
                $level = '';
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

    public function avatar()
    {
        if (strpos($this->avatar, 'http')) {
            return $this->avatar;
        }
        return asset($this->avatar);
    }
}
