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
            'CNTT-10A1' => 1,
            'CNTT-10A2' => 1,
            'CNTT-10A3' => 1,
            'CNTT-10A4' => 1,
            'CNTT-10A5' => 1,
            'CK-10A1' => 2,
            'CK-10A2' => 2,
            'CK-10A3' => 2,
            'CK-10A4' => 2,
            'CK-10A5' => 2,
            'CN-OTO-10A1' => 3,
            'CN-OTO-10A2' => 3,
            'CN-OTO-10A3' => 3,
            'CN-OTO-10A4' => 3,
            'CN-OTO-10A5' => 3,
            'DIEN-10A1' => 4,
            'DIEN-10A2' => 4,
            'DIEN-10A3' => 4,
            'DIEN-10A4' => 4,
            'DIEN-10A5' => 4,
            'DIEN-TU-10A1' => 5,
            'DIEN-TU-10A2' => 5,
            'DIEN-TU-10A3' => 5,
            'DIEN-TU-10A4' => 5,
            'DIEN-TU-10A5' => 5,
            'DL-10A1' => 6,
            'DL-10A2' => 6,
            'DL-10A3' => 6,
            'DL-10A4' => 6,
            'DL-10A5' => 6,
            'QLKD-10A1' => 7,
            'QLKD-10A2' => 7,
            'QLKD-10A3' => 7,
            'QLKD-10A4' => 7,
            'QLKD-10A5' => 7,
            'KT-KT-10A1' => 8,
            'KT-KT-10A2' => 8,
            'KT-KT-10A3' => 8,
            'KT-KT-10A4' => 8,
            'KT-KT-10A5' => 8,
            'CNH-10A1' => 9,
            'CNH-10A2' => 9,
            'CNH-10A3' => 9,
            'CNH-10A4' => 9,
            'CNH-10A5' => 9,
            'NN-10A1' => 10,
            'NN-10A2' => 10,
            'NN-10A3' => 10,
            'NN-10A4' => 10,
            'NN-10A5' => 10,
        ];
        $name = $this->faker->unique()->randomKey($class);
        $departmentId = $class[$name];
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'department_id' => $departmentId,
            'activated' => 1
        ];
    }
}
