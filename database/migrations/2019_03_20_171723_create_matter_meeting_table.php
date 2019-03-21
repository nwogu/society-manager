<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatterMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matter_meeting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matter_id')->unsigned();
            $table->integer('meeting_id')->unsigned();
            $table->timestamps();

            $table->foreign('matter_id')->references('id')->on('matters')->onDelete('cascade');
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matter_meeting');
    }
}
