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
            $table->date('tgl_input');
            $table->unsignedBigInteger('id_witel');
            $table->string('divisi');
            $table->string('name');
            $table->string('no_telp');
            $table->string('nama_pelanggan');
            $table->string('jenis_produk');
            $table->string('deskripsi');
            $table->string('lampiran');
            $table->date('dateline');
            $table->string('status');
            $table->string('keterangan');
            $table->string('lampiran2');

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
