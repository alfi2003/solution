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
        Schema::create('solusis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('solusi');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_witel');
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
        Schema::dropIfExists('solusis');
    }
};
