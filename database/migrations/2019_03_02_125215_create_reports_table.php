<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('society_id')->unsigned();
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->text('report');
            $table->morphs('reportable');
            $table->timestamps();

            $table->foreign('society_id')->references('id')->on('societies')->onDelete('cascade');
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
