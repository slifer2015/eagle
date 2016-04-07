<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('file');
            $table->string('duration');
            $table->string('capacity');
            $table->string('level');
            $table->boolean('is_free')->default(0);
            $table->integer('num_like')->unsigned()->default(0);
            $table->integer('num_dislike')->unsigned()->default(0);
            $table->integer('num_comment')->unsigned()->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();


        });

        Schema::create('session_tag',function(Blueprint $table){
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->integer('session_id')->unsigned();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
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
        Schema::drop('session_tag');
        Schema::drop('sessions');
    }
}
