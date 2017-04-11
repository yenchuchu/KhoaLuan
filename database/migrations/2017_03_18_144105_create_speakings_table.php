<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakings', function (Blueprint $table) {
            $table->increments('id');

            $table->text('content');
            $table->text('url_mp3')->nullable();
            $table->string('type_user');
            $table->integer('class_id')->nullable();
            $table->integer('exam_type_id')->nullable();
            $table->integer('bookmap_id')->nullable();
            $table->integer('skill_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->tinyInteger('status')->defaul(0)->comment('0-chua active, 1-active');
            $table->integer('type_code');
            $table->integer('user_id');

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
        Schema::dropIfExists('speakings');
    }
}
