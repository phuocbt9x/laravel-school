<?php

namespace Database\Seeders;

use App\Models\LoginModel;
use App\Models\StudentModel;
use Illuminate\Database\Seeder;

class LoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoginModel::factory()->count(200)->has(
            StudentModel::factory()->count(1)->state(function (array $attributes, LoginModel $login) {
                return ['login_id' => $login->id];
            }),
            'getInfo'
        )->create();
    }
}
