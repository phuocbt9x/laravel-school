<?php

namespace Database\Factories;

use App\Models\CourseModel;
use App\Models\LoginModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Buihuycuong\Vnfaker\VNFaker as vnfake;
use Nette\Utils\Random;

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
        return [
            'fullname' => vnfake::fullname(),
            'gender' => random_int(0, 1),
            'birthdate' => $this->faker->date(),
            'avatar' => $this->faker->imageUrl($with = 400, $height = 400),
            'phone' => vnfake::mobilephone(),
            'course_id' => random_int(1, 50),
            'address' => 'Phú Khu',
            'city_id' => '34',
            'district_id' => '339',
            'ward_id' =>  '12673'
        ];
    }
}
