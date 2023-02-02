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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisi')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('durasi_id')->constrained('durasi')->onUpdate('cascade')->onDelete('cascade'); 
            $table->enum('status', ['belum diproses','lolos berkas','diterima', 'tidak lolos']);
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('instansi');
            $table->string('lokasi', 50);
            $table->enum('pendidikan', ['siswa', 'mahasiswa']);
            $table->string('foto');
            $table->string('surat_pengantar');
            $table->string('proposal');
            $table->string('cv');
            $table->string('vaksin');
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
        Schema::dropIfExists('pendaftar');
    }
};
