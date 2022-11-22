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
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('teacher_id');
            $table->boolean('type')->default(0);
            $table->date('date');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_schedules');
    }
};
