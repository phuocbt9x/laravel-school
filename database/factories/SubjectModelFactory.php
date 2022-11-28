<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectModel>
 */
class SubjectModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->randomElement([
            'Toán ứng dụng',
            'Xác suất thống kê',
            'Kinh tế vi mô',
            'Kinh tế phát triển',
            'Kinh tế môi trường',
            'Chủ nghĩa xã hội khoa học',
            'Tin học đại cương',
            'Kinh tế chính trị Mác Lênin',
            'Xác xuất thống kê',
            'Toán rời rạc',
            'Tư tưởng Hồ Chí Minh',
            'Giao nhận vận tải',
            'Giáo dục quốc phòng',
            'Tổ chức sự kiện',
        ]);
        
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'activated' => 1
        ];
    }
}
