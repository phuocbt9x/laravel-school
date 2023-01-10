<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTimeModel extends Model
{
    use HasFactory;
    protected $table = 'subject_times';
    protected $fillable = ['assignment_id', 'shift_id'];

    public function getAssignment()
    {
        return $this->hasOne(AssignmentModel::class, 'id', 'assignment_id');
    }

    public function getShift()
    {
        return $this->hasOne(ShiftModel::class, 'id', 'shift_id');
    }
}
