<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_witel',
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
}
