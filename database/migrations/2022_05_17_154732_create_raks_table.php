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
        Schema::create('raks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rak');
            $table->string('nama_rak');
            $table->string('kode_nama')->virtualAs('concat(kode_rak, \' - \', nama_rak)');
            $table->longText('deskripsi');
            $table->string('qr_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('raks');
    }
};
