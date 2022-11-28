<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseModel>
 */
class CourseModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $class = [
            1 => [
                'CNTT-10A1',
                'CNTT-10A2',
                'CNTT-10A3',
                'CNTT-10A4',
                'CNTT-10A5'
            ],
            2 => [
                'CK-10A1',
                'CK-10A2',
                'CK-10A3',
                'CK-10A4',
                'CK-10A5'
            ],
            3 => [
                'CN-OTO-10A1',
                'CN-OTO-10A2',
                'CN-OTO-10A3',
                'CN-OTO-10A4',
                'CN-OTO-10A5'
            ],
            4 => [
                'DIEN-10A1',
                'DIEN-10A2',
                'DIEN-10A3',
                'DIEN-10A4',
                'DIEN-10A5'
            ],
            5 => [
                'DIEN-TU-10A1',
                'DIEN-TU-10A2',
                'DIEN-TU-10A3',
                'DIEN-TU-10A4',
                'DIEN-TU-10A5'
            ],
            6 => [
                'DL-10A1',
                'DL-10A2',
                'DL-10A3',
                'DL-10A4',
                'DL-10A5'
            ],
            7 => [
                'QLKD-10A1',
                'QLKD-10A2',
                'QLKD-10A3',
                'QLKD-10A4',
                'QLKD-10A5'
            ],
            8 => [
                'KT-KT-10A1',
                'KT-KT-10A2',
                'KT-KT-10A3',
                'KT-KT-10A4',
                'KT-KT-10A5'
            ],
            9 => [
                'CNH-10A1',
                'CNH-10A2',
                'CNH-10A3',
                'CNH-10A4',
                'CNH-10A5'
            ],
            10 => [
                'NN-10A1',
                'NN-10A2',
                'NN-10A3',
                'NN-10A4',
                'NN-10A5'
            ],
        ];
        $departmentId = array_rand($class);
        $classArr = $class[$departmentId];
        $name = $this->faker->unique()->randomElement($classArr);        

        $slug = Str::slug($name);        
        // dd($departmentId , $classArr , $name);

        return [
            'name' => $name,
            'slug' => $slug,
            'department_id' => $departmentId,
            'activated' => 1
        ];
    }
}
