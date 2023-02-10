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
        Schema::create('jenis_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('kode_arsip');
            $table->string('jenis_arsip');
            $table->string('kode_jenis')->virtualAs('concat(kode_arsip, \' - \', jenis_arsip)');
            $table->string('retensi');
            $table->string('deskripsi');
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
        Schema::dropIfExists('jenis_arsips');
    }
};
