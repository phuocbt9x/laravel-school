<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DepartmentModel>
 */
class DepartmentModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->randomElement([
            'Công nghệ thông tin',
            'Cơ khí',
            'Công nghệ ô tô',
            'Điện',
            'Điện tử',
            'Du lịch',
            'Quản lý kinh doanh',
            'Kế toán - kiểm toán',
            'Công nghệ hóa',
            'Ngoại ngữ'
        ]);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'activated' => 1
        ];
    }
}
