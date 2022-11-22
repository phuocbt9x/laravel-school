<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class LoginModel extends User
{
    use HasFactory;
    protected $table = 'logins';
    protected $fillable = ['email', 'password', 'level', 'activated'];
    protected $hidden = ['password'];
}
