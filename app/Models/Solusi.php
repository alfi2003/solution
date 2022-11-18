<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Witel;

class Solusi extends Model
{
    use HasFactory;

    protected $table='solusis';

    protected $fillable = [
        'name',
        'solusi',
        'tanggal',
        'id_witel',
    ];

    public function witels()
    {
        return $this->belongsTo(Witel::class, 'id_witel', 'id');
    }


}
