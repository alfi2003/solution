<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class WitelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('witels')->insert([
            [
                'witel' => 'PURWOKERTO',
                'singkatan' => 'PWT',
                'alamat' => 'Jl. Purwokerto',
            ],
            [
                'witel' => 'KUDUS',
                'singkatan' => 'KDS',
                'alamat' => 'Jl. Kudus',
            ],
            [
                'witel' => 'SOLO',
                'singkatan' => 'SLO',
                'alamat' => 'Jl. Solo',
            ],
            [
                'witel' => 'SEMARANG',
                'singkatan' => 'SMG',
                'alamat' => 'Jl. Semarang',
            ],
            [
                'witel' => 'PEKALONGAN',
                'singkatan' => 'PKL',
                'alamat' => 'Jl. Pekelongan',
            ],
            [
                'witel' => 'MAGELANG',
                'singkatan' => 'MGL',
                'alamat' => 'Jl. Magelang',
            ],
            [
                'witel' => 'YOGYAKARTA',
                'singkatan' => 'YK',
                'alamat' => 'Jl. Yogyakarta',
            ],
            [
                'witel' => 'REGIONAL',
                'singkatan' => 'REG',
                'alamat' => 'Jl. Pahlawan',
            ]
        ]);
    }
}
