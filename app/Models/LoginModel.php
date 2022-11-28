<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginModel extends User
{
    use HasFactory;
    protected $table = 'logins';
    protected $fillable = ['email', 'password', 'level', 'activated'];
    protected $hidden = ['password'];
    
    public function getInfo()
    {
        return $this->hasOne(TeacherModel::class, 'login_id', 'id');
    }

    public function isManager()
    {
        if ($this->level == 1) {
            return true;
        }
        return false;
    }



    public function isTeacher()
    {
        if ($this->level == 2) {
            return true;
        }
        return false;
    }

    public function isStudent()
    {
        if ($this->level == 3) {
            return true;
        }
        return false;
    }
}
