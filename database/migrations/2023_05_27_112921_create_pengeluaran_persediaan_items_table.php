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
        Schema::create('pengeluaran_persediaan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengeluaran_persediaan_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('persediaan_id')->nullable()->constrained()->cascadeOnDelete();
            $table->integer('jumlah');
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
        Schema::dropIfExists('pengeluaran_persediaan_items');
    }
};
