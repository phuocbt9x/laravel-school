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
             'time_start' => "06:45",
             'time_end' => "07:45"
            ],
            2 => [
             'title' => 'Ca 2',
             'time_start' => "07:45",
             'time_end' => "08:45"
            ],
            3 => [
             'title' => 'Ca 3',
             'time_start' => "09:45",
             'time_end' => "10:45"
            ],
            4 => [
             'title' => 'Ca 4',
             'time_start' => "11:45",
             'time_end' => "12:45"
            ],
         ];
         $key = $this->faker->unique()->randomKey($shift);
         $title = $shift[$key]['title'];
         $time_start = $shift[$key]['time_start'];
         $time_end = $shift[$key]['time_end'];
         
         // $start = $this->faker->dateTimeBetween(, 'next Monday +7 days');
        
         $slug = Str::slug($title);
         return [
             'title' => $title,
             'slug' => $slug,
             'time_start' => $time_start,
             'time_end' => $time_end
 
         ];
    }
}
