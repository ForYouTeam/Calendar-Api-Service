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
            $table->foreignId('detail_kegiatan')->constrained('detail_kegiatan');
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_berakhir');
            $table->string('nama_kegiatan');
            $table->string('keterangan');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
}
