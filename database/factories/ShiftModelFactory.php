<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShiftModel>
 */
class ShiftModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $shift = [
            1 => [
                'title' => 'Ca 1',
                'time_start' => "07:00",
                'time_end' => "07:45"
            ],
            2 => [
                'title' => 'Ca 2',
                'time_start' => "7:50",
                'time_end' => "08:35"
            ],
            3 => [
                'title' => 'Ca 3',
                'time_start' => "08:40",
                'time_end' => "09:25"
            ],
            4 => [
                'title' => 'Ca 4',
                'time_start' => "09:30",
                'time_end' => "10:15"
            ],
            5 => [
                'title' => 'Ca 5',
                'time_start' => "10:20",
                'time_end' => "11:05"
            ],
            6 => [
                'title' => 'Ca 6',
                'time_start' => "11:10",
                'time_end' => "11:55"
            ],
            7 => [
                'title' => 'Ca 7',
                'time_start' => "13:00",
                'time_end' => "13:45"
            ],
            8 => [
                'title' => 'Ca 8',
                'time_start' => "13:50",
                'time_end' => "14:35"
            ],
            9 => [
                'title' => 'Ca 9',
                'time_start' => "14:40",
                'time_end' => "15:20"
            ],
            10 => [
                'title' => 'Ca 10',
                'time_start' => "15:25",
                'time_end' => "16:10"
            ],
            11 => [
                'title' => 'Ca 11',
                'time_start' => "16:15",
                'time_end' => "17:00"
            ],
            12 => [
                'title' => 'Ca 12',
                'time_start' => "17:05",
                'time_end' => "17:50"
            ],
            13 => [
                'title' => 'Ca 13',
                'time_start' => "17:55",
                'time_end' => "18:40"
            ]
        ];
        $key = $this->faker->unique()->randomKey($shift);
        $title = $shift[$key]['title'];
        $time_start = $shift[$key]['time_start'];
        $time_end = $shift[$key]['time_end'];

        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'activated' => 1
        ];
    }
}
