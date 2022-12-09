<?php

namespace Database\Factories;

use App\Models\CourseModel;
use App\Models\StudentModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**   
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignmentModel>
 */
class AssignmentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ass = CourseModel::inRandomOrder()->first()->name;    
        //$stu = StudentModel::factory();    
        
        return [
            //
        ];
    }
}
