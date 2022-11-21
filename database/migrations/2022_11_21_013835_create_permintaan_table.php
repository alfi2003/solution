<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('id_witel');
            $table->string('divisi');
            $table->string('nama_pelanggan');
            $table->string('permintaan');
            $table->string('solusi');
            $table->date('tgl_input');
            $table->date('tgl_selesai');
            $table->string('jenis_produk');
            $table->string('kategori');
            $table->string('jumlah');
            $table->string('lokasi');
            $table->string('perkiraan_budget');
            $table->string('keterangan');
            $table->timestamps();


            $table->foreign('id_witel')->references('id')->on('witels')  ->update('cascade')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaan');
    }
};
