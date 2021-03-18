<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('username');
            $table->string('validator');
            $table->string('kode_surat');
            $table->date('tanggal_masuk_surat');
            $table->integer('nomor_surat');
            $table->string('lampiran');
            $table->string('perihal');
            $table->string('nama_kegiatan');
            $table->date('tanggal_surat');
            $table->string('waktu');
            $table->string('tempat');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('up_surat');
            $table->string('status_surat');
            $table->string('update_by')->nullable();
            $table->string('notes')->nullable();
            $table->string('lembaga')->nullable();
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
        Schema::dropIfExists('surats');
    }
}
