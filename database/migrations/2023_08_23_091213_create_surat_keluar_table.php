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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bidang');
            $table->string('alamat_tujuan');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->string('sifat');
            $table->string('perihal');
            $table->string('lampiran');
            $table->string('file');
            $table->foreign('id_bidang')->references('id')->on('bidang');
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
        Schema::dropIfExists('surat_keluar');
    }
};
