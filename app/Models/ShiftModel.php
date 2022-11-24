<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftModel extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $fillable = [
        'title', 'slug', 'time_start', 'time_end', 'activated'
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

    public function timeStart()
    {
        return date('H:i', strtotime($this->time_start));
    }

    public function timeEnd()
    {
        return date('H:i', strtotime($this->time_end));
    }
}