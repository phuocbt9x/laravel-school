<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeStartModel extends Model
{
    use HasFactory;
    protected $table = 'timestarts';
    protected $fillable = ['exam_schedule_id', 'timestart'];
}
