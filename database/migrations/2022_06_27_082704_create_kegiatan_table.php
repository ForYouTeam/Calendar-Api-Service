<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('kegiatan');
            $table->dateTime('waktu');
            $table->string('keterangan');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
}
