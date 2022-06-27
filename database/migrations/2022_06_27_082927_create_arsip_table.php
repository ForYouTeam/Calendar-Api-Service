<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipTable extends Migration
{
    public function up()
    {
        Schema::create('arsip', function (Blueprint $table) {
            $table->id();
            $table->date('bulan_arsip');
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip');
    }
}
