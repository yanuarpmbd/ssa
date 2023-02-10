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
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_arsip');
            $table->integer('unit_kerja_id');
            $table->string('nama_arsip');
            $table->integer('rak_id');
            $table->integer('dus_id');
            $table->date('tanggal_arsip');
            $table->string('tingkat_perkembangan');
            $table->integer('status');
            $table->longText('deskripsi')->nullable();
            $table->string('upload_arsip')->nullable();
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
        Schema::dropIfExists('arsips');
    }
};
