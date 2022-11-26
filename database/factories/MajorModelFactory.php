<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            1 => [
                'Khoa học máy tính',
                'Kỹ thuật phần mềm',
                'Hệ thống thông tin',
                'Công nghệ thông tin'
            ],
            2 => [
                'Công nghệ kỹ thuật cơ khí',
                'Công nghệ kỹ thuật cơ khí điện tử',
                'Công nghệ chế tạo máy'
            ],
            3 => [
                'Công nghệ kỹ thuật ô tô',
                'Cơ khí động lực',
                'Sữa chữa ô tô - xe máy'
            ],
            4 => [
                'Công nghệ kỹ thuật điện',
                'Công nghệ kỹ thuật điện, điện tử',
                'Công nghệ kỹ thuật điều khiển và tự động hóa'
            ],
            5 => [
                'Công nghệ kỹ thuật điện tử',
                'Công nghệ kỹ thuật điện tử viễn thông',
                'Công nghệ kỹ thuật điện tử tự động',
                'Công nghệ kỹ thuật điện tử tin học'
            ],
            6 => [
                'Du lịch',
                'Quản trị dịch vụ du lịch và lữ hành',
                'Quản trị khách sạn',
            ],
            7 => [
                'Quản trị kinh doanh',
                'Quản trị marketing',
                'Tài chính doanh nghiệp',
                'Kinh tế đầu tư',
            ],
            8 => [
                'Kế toán',
                'Kiểm toán'
            ],
            9 => [
                'Công nghệ hóa vô cơ',
                'Công nghệ hóa hữu cơ',
                'Công nghệ hóa phân tích'
            ],
            10 => [
                'Ngôn ngữ Anh',
                'Ngôn ngữ Trung',
                'Ngôn ngữ Nhật'
            ],
        ];

        return [
            //
        ];
    }
}
