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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('no_lpb', 20);
            $table->date('tanggal');
            $table->foreignId('supplier_id')->references('id')->on('supplier')->onDelete('cascade');
            $table->foreignId('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->string('diskon');
            $table->string('ppn');
            $table->string('satuan');
            $table->string('jumlah');
            $table->string('subtotla');
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
        Schema::dropIfExists('pembelian');
    }
};
