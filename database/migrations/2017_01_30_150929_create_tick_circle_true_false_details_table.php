<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickCircleTrueFalseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tick_circle_true_false_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tick_circle_true_false_id');
            $table->string('title');
            $table->string('content_json');
            $table->string('answer');

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
        Schema::dropIfExists('tick_circle_true_false_details');
    }
}
