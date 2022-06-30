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
        'detail_kegiatan',
        'tgl_mulai',
        'tgl_berakhir',
        'nama_kegiatan',
        'keterangan',
    ];

    function kegiatanRole()
    {
        return $this->belongsTo(DetailKegiatanModel::class, 'detail_kegiatan');
    }
}
