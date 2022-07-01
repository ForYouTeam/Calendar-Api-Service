<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_service', function (Blueprint $table) {
            $table->id();
            $table->string('calendar_id');
            $table->boolean('sentUpdate')->default(false);
            $table->date('startDateTime');
            $table->date('endDateTime');
            $table->string('name');
            $table->string('location');
            $table->string('status')->default('confirmed');
            $table->longText('description');
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
        Schema::dropIfExists('calendar_service');
    }
}
