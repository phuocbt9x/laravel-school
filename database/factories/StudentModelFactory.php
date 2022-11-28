<?php

namespace Database\Factories;

use App\Models\CourseModel;
use App\Models\LoginModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentModel>
 */
class StudentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $login_id = LoginModel::all('id');
        // $course_id = CourseModel::all('id');
        // return [
        //     'name' => $this->faker->name(),
        //     'gender' => random_int(0, 1),
        //     'birthday' => $this->faker->date(),
        //     'login_id' => $this->faker->unique()->randomElement($login_id),
        //     'avatar' => $this->faker->unique()->image(),
        //     'course_id' => $this->faker->randomElement($course_id),
        //     'address' => 'Phú Khu',
        //     'city_id' => '34',
        //     'district_id' => '339',
        //     'ward_id' =>  '12673'
        // ];
    }
}
