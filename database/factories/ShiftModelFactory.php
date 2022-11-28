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
           'Ca 1' => [
            "06g45' đến 09g00'"
           ],
           'Ca 2' => [
            "09g20' đến 11g35'"
           ],
           'Ca 3' => [
            "12g30' đến 14g45'"
           ],
           'Ca 4' => [
            "15g05' đến 17g20'"
           ],
           'Ca 5' => [
            "18g00' đến 20g15'"
           ], 
        ];
        $title = array_rand($shift);
        dd($title);
        // $start = $this->faker->dateTimeBetween(, 'next Monday +7 days');
        $time = $title[$title];
        $name = $this->faker->randomElement($time); 
        $slug = Str::slug($title);
        return [
            
        ];
    }
}
