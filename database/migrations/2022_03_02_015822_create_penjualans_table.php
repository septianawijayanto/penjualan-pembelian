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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->foreignId('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->string('diskon');
            $table->string('ket', 100);
            $table->integer('subtotal');
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
        Schema::dropIfExists('penjualan');
    }
};
