<?php

use App\Constants;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id')->unsigned();
            $table->integer('raised_by')->unsigned()->nullable();
            $table->text('matter');
            $table->text('details')->nullable();
            $table->integer('meeting_id')->unsigned()->nullable();
            $table->string('status')->default(Constants::MATTERS_ARISING);
            $table->timestamps();

            $table->foreign('society_id')->references('id')->on('societies')->onDelete('cascade');
            $table->foreign('raised_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('meeting_id')->references('id')->on('meeting')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matters');
    }
}
