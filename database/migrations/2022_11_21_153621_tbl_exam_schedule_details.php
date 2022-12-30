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
        Schema::create('exam_schedule_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exam_schedule_id');
            $table->unsignedInteger('student_id');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('exam_schedule_id')
                ->references('id')
                ->on('exam_schedules');
            $table->foreign('student_id')
                ->references('id')
                ->on('students');
            // $table->unique(['exam_schedule_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_schedule_details');
    }
};
