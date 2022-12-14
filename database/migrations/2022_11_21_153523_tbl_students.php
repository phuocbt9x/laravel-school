<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->boolean('gender')->default(0);
            $table->timestamp('birthdate');
            $table->unsignedInteger('login_id');
            $table->string('avatar');
            $table->string('phone');
            $table->unsignedInteger('course_id');
            $table->string('address');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('ward_id');
            $table->timestamps();
            $table->foreign('course_id')
                ->references('id')
                ->on('courses');
            $table->foreign('login_id')
                ->references('id')
                ->on('logins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
