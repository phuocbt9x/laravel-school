<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTimeModel extends Model
{
    use HasFactory;
    protected $table = 'subject_times';
    protected $fillable = ['assignment_id', 'shift_id'];
}
