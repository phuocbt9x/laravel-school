<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartmentTableSeeder::class,
            SubjectTableSeeder::class,
            ShiftTableSeeder::class,
            LoginTableSeeder::class,
            // StudentTableSeeder::class,
            // CourseTableSeeder::class
            
        ]);
        $manager =  DB::table('logins')->insertGetId([
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
            'level' => 1,
            'activated' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

        DB::table('teachers')->insert([
            'fullname' => 'admin',
            'gender' => 1,
            'birthdate' => date('Y-m-d H:m:s'),
            'login_id' => $manager,
            'avatar' => 'https://via.placeholder.com/400x400.png/00dd66?text=quidem',
            'phone' => '0975041697',
            'address' => 'Phú Khu',
            'city_id' => '34',
            'district_id' => '339',
            'ward_id' =>  '12673',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
