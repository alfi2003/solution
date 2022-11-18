<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Solusi;
use App\Models\Customer;

class Witel extends Model
{
    use HasFactory;

    protected $fillable = [
        'witel',
        'singkatan',
        'alamat',
    ];

    public function solusis()
    {
        return $this->hasMany(Solusi::class, 'id_witel', 'id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'id_witel', 'id');
    }
}
