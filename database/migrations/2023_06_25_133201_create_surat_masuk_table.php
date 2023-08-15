<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('asal_surat');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->string('perihal');
            $table->timestamp('tanggal_diterima')->useCurrent();
            $table->string('jenis');
            $table->string('file');
            $table->string('lampiran');
            $table->string('sifat');
            $table->string('catatan')->nullable();
            $table->smallInteger('tindakan')->default(0);
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
        Schema::dropIfExists('surat_masuk');
    }
};
