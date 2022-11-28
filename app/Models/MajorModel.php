<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MajorModel extends Model
{
    use HasFactory;
    protected $table = 'majors';
    protected $fillable = [
        'name', 'slug', 'department_id', 'activated'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function department()
    {
        return $this->hasOne(DepartmentModel::class, 'id', 'department_id');
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
}
