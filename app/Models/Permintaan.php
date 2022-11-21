<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $table = 'permintaan';

    protected $fillable = [
        'name',
        'id_witel',
        'divisi',
        'nama_pelanggan',
        'permintaan',
        'solusi',
        'tgl_input',
        'tgl_selesai',
        'jenis_produk',
        'kategori',
        'jumlah',
        'lokasi',
        'perkiraan_budget',
        'keterangan',
    ];

    public function witels()
    {
        return $this->belongsTo(Witel::class, 'id_witel', 'id');
    }
}


