<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKegiatanModel extends Model
{
    use HasFactory;
    protected $table = "detail_kegiatan";
    protected $fillable = [
        'id',
        'pegawai_id',
        'tempat',
        'pakaian',
        'penyelenggara',
        'pejabat_menghadiri',
        'protokol',
        'kopim',
        'dokpim',
    ];
    
    function pegawaiRole (){
        $this->belongsTo(PegawaiModel::class, 'pegawai_id');
    }
}
