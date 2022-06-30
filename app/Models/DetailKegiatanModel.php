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
        'tempat',
        'pakaian',
        'penyelenggara',
        'penjabat_menghadiri',
        'protokol',
        'kopim',
        'dokpim',
    ];

    function protokolRole()
    {
        return $this->belongsTo(PegawaiModel::class, 'protokol');
    }
    function kopimRole()
    {
        return $this->belongsTo(PegawaiModel::class, 'kopim');
    }
    function dokpimRole()
    {
        return $this->belongsTo(PegawaiModel::class, 'dokpim');
    }
}
