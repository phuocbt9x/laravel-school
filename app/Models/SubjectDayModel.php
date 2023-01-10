<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectDayModel extends Model
{
    use HasFactory;
    protected $table = 'subject_days';
    protected $fillable = ['assignment_id', 'day_id'];

    public function getAssignment()
    {
        return $this->hasOne(AssignmentModel::class, 'id', 'assignment_id');
    }
    
    
}
