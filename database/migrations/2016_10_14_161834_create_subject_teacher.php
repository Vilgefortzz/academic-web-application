<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->integer('teacher_id')->unsigned()->index();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->integer('subject_id')->unsigned()->index();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_teacher');
    }
}
