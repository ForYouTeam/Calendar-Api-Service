<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKegiatanTable extends Migration
{
    public function up()
    {
        Schema::create('detail_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai');
            $table->string('tempat');
            $table->string('pakaian');
            $table->string('penyelenggara');
            $table->string('pejabat_menghadiri');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_kegiatan');
    }
}
