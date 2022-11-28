<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MajorModel>
 */
class MajorModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $major = [
            'Khoa học máy tính' => 1,
            'Kỹ thuật phần mềm' => 1,
            'Hệ thống thông tin' => 1,
            'Công nghệ thông tin' => 1,
            'Công nghệ kỹ thuật cơ khí' => 2,
            'Công nghệ kỹ thuật cơ khí điện tử' => 2,
            'Công nghệ chế tạo máy' => 2,
            'Công nghệ kỹ thuật ô tô' => 3,
            'Cơ khí động lực' => 3,
            'Sữa chữa ô tô - xe máy' => 3,
            'Công nghệ kỹ thuật điện' => 4,
            'Công nghệ kỹ thuật điện, điện tử' => 4,
            'Công nghệ kỹ thuật điều khiển và tự động hóa' => 4,
            'Công nghệ kỹ thuật điện tử' => 5,
            'Công nghệ kỹ thuật điện tử viễn thông' => 5,
            'Công nghệ kỹ thuật điện tử tự động' => 5,
            'Công nghệ kỹ thuật điện tử tin học' => 5,
            'Du lịch' => 6,
            'Quản trị dịch vụ du lịch và lữ hành' => 6,
            'Quản trị khách sạn' => 6,
            'Quản trị kinh doanh' => 7,
            'Quản trị marketing' => 7,
            'Tài chính doanh nghiệp' => 7,
            'Kinh tế đầu tư' => 7,
            'Kế toán' => 8,
            'Kiểm toán' => 8,
            'Công nghệ hóa vô cơ' => 9,
            'Công nghệ hóa hữu cơ' => 9,
            'Công nghệ hóa phân tích' => 9,
            'Ngôn ngữ Anh' => 10,
            'Ngôn ngữ Trung' => 10,
            'Ngôn ngữ Nhật' => 10,
        ];

        $name = $this->faker->unique()->randomKey($major);
        $departmentId = $major[$name];
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'department_id' => $departmentId,
            'activated' => 1
        ];
    }
}
