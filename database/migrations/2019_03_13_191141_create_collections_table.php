<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id')->unsigned();
            $table->string('type');
            $table->integer('amount');
            $table->integer('received');
            $table->text('description')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('member')->unsigned();
            $table->dateTime('collection_date')->nullable();
            $table->integer('recorder')->unsigned()->nullable();
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->integer('commitee_id')->unsigned()->nullable();
            $table->dateTime('start_period')->nullable();
            $table->dateTime('end_period')->nullable();
            $table->timestamps();

            $table->foreign('society_id')->references('id')->on('societies');
            $table->foreign('member')->references('id')->on('users');
            $table->foreign('commitee_id')->references('id')->on('commitees');
            $table->foreign('recorder')->references('id')->on('users');
            $table->foreign('meeting_id')->references('id')->on('meetings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
}
