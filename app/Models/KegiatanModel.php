<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    use HasFactory;
    protected $table = "kegiatan";
    protected $fillable = [
        'id',
        'kegiatan_id',
        'tgl',
        'kegiatan',
        'waktu',
        'keterangan',
    ];

    function kegiatanRole (){
        $this->belongsTo(KegiatanModel::class, 'kegiatan_id');
    }
}
