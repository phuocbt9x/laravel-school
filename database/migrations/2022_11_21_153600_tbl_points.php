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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('student_id');
            $table->float('diligence'); //điểm chuyên cần
            $table->float('mid_term');
            $table->float('final');
            $table->float('total');
            $table->boolean('activated')->default(0);
            $table->timestamps();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
            $table->foreign('student_id')
                ->references('id')
                ->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
};
