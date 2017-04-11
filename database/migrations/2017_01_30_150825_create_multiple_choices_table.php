<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMultipleChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_choices', function (Blueprint $table) {
            $table->increments('id');

            $table->text('title');
            $table->text('content')->nullable();
            $table->integer('point')->default(0);
            $table->text('content_json')->comment('{content: nội dung câu hỏi, suggest_choose: đưa ra 4 lựa chọn, answer: đáp án}');
            $table->string('type_user');
            $table->integer('class_id')->nullable();
            $table->integer('exam_type_id')->nullable();
            $table->integer('bookmap_id')->nullable();
            $table->integer('skill_id')->nullable();
            $table->integer('level_id')->nullable();
            $table->integer('type_code');
            $table->integer('user_id');
            $table->tinyInteger('status')->defaul(0)->comment('0-chua active, 1-active');

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
        Schema::dropIfExists('multiple_choices');
    }
}
