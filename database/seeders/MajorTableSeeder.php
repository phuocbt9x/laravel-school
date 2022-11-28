<?php

namespace Database\Seeders;

use App\Models\MajorModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MajorModel::factory()->count(10)->create();
    }
}
