<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'name', 'slug', 'activated'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function status()
    {
        switch ($this->activated) {
            case '1':
                $status = '<span class="badge badge-pill bg-gradient-success">Kích hoạt</span>';
                break;

            default:
                $status = '<span class="badge badge-pill bg-gradient-danger">Ẩn</span>';
                break;
        }

        return $status;
    }

    public function getCourses()
    {
        return $this->hasMany(CourseModel::class, 'department_id', 'id');
    }
}
