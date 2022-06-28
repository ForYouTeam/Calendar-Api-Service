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
        'keterangan',
    ];

    function kegiatanRole (){
       return $this->belongsTo(DetailKegiatanModel::class, 'kegiatan_id');
    }
}
