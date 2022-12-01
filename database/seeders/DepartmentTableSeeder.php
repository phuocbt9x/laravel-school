<?php

namespace Database\Seeders;

use App\Models\CourseModel;
use App\Models\DepartmentModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepartmentModel::factory()->count(10)->has(
            CourseModel::factory()->count(5)->state(function (array $attributes, DepartmentModel $departmentModel) {
                $class = [
                    'Công nghệ thông tin' => [
                        'CNTT-10A1',
                        'CNTT-10A2',
                        'CNTT-10A3',
                        'CNTT-10A4',
                        'CNTT-10A5'
                    ],
                    'Cơ khí' => [
                        'CK-10A1',
                        'CK-10A2',
                        'CK-10A3',
                        'CK-10A4',
                        'CK-10A5'
                    ],
                    'Công nghệ ô tô' => [
                        'CN-OTO-10A1',
                        'CN-OTO-10A2',
                        'CN-OTO-10A3',
                        'CN-OTO-10A4',
                        'CN-OTO-10A5'
                    ],
                    'Điện' => [
                        'DIEN-10A1',
                        'DIEN-10A2',
                        'DIEN-10A3',
                        'DIEN-10A4',
                        'DIEN-10A5'
                    ],
                    'Điện tử' => [
                        'DIEN-TU-10A1',
                        'DIEN-TU-10A2',
                        'DIEN-TU-10A3',
                        'DIEN-TU-10A4',
                        'DIEN-TU-10A5'
                    ],
                    'Du lịch' => [
                        'DL-10A1',
                        'DL-10A2',
                        'DL-10A3',
                        'DL-10A4',
                        'DL-10A5'
                    ],
                    'Quản lý kinh doanh' => [
                        'QLKD-10A1',
                        'QLKD-10A2',
                        'QLKD-10A3',
                        'QLKD-10A4',
                        'QLKD-10A5',
                    ],
                    'Kế toán - kiểm toán' => [
                        'KT-KT-10A1',
                        'KT-KT-10A2',
                        'KT-KT-10A3',
                        'KT-KT-10A4',
                        'KT-KT-10A5'
                    ],
                    'Công nghệ hóa' => [
                        'CNH-10A1',
                        'CNH-10A2',
                        'CNH-10A3',
                        'CNH-10A4',
                        'CNH-10A5'
                    ],
                    'Ngoại ngữ' => [
                        'NN-10A1',
                        'NN-10A2',
                        'NN-10A3',
                        'NN-10A4',
                        'NN-10A5'
                    ],
                ];
                $classArr = $class[$departmentModel->name];
                $nameCourse = fake()->unique()->randomElement($classArr);
                return [
                    'name' => $nameCourse,
                    'slug' => Str::slug($nameCourse),
                    'department_id' => $departmentModel->id
                ];
            }),
            'getCourses'
        )->create();
    }
}
