<?php

namespace Database\Factories;

use App\Models\AssignmentModel;
use App\Models\AttendanceModel;
use App\Models\CourseModel;
use App\Models\StudentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceModel>
 */
class AttendanceModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        //$course = CourseModel::class->pluck('id')->toArray()
       
        return [
            //'assignment_id' => AssignmentModel::inRandomOrder()->first()->id,
             
        ];
        
        
    }
}
