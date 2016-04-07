<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->integer('price')->default(0);
            $table->string('image');
            $table->integer('num_student')->unsigned()->default(0);
            $table->integer('num_like')->unsigned()->default(0);
            $table->integer('num_dislike')->unsigned()->default(0);
            $table->integer('num_comment')->unsigned()->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('course_tag',function(Blueprint $table){
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->timestamps();

        });

        Schema::create('category_course',function(Blueprint $table){
            $table->integer('course_id')->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_course');
        Schema::drop('course_tag');
        Schema::drop('courses');
    }
}
