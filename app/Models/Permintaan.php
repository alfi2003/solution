<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'tgl_input',
        'id_witel',
        'divisi',
        'name',
        'no_telp',
        'nama_pelanggan',
        'jenis_produk',
        'deskripsi',
        'lampiran',
        'dateline',
        'status',
        'keterangan',
        'lampiran2',


    ];

    public function witels()
    {
        return $this->belongsTo(Witel::class, 'id_witel', 'id');
    }
}


