<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListenTickCrossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listen_tick_crosses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('example_json')->comment('{ {id, url_image} , answer: 1(true) hoac 0(false)}');
            $table->text('content_json')->comment('{ { id, url_image , answer: 1/0} }');
            $table->text('url');
            $table->integer('point')->default(0);
            $table->tinyInteger('status')->defaul(0)->comment('0-chua active, 1-active');

            $table->string('type_user');
            $table->integer('class_id')->nullable();
            $table->integer('exam_type_id')->nullable();
            $table->integer('bookmap_id')->nullable();
            $table->integer('skill_id')->nullable();
            $table->integer('level_id')->nullable();
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
        Schema::dropIfExists('listen_tick_crosses');
    }
}
