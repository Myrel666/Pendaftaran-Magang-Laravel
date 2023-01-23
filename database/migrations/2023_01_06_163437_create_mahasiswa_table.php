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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('divisi_id')->constrained('divisi')->onUpdate('cascade')->onDelete('cascade'); 
            $table->foreignId('durasi_id')->constrained('durasi')->onUpdate('cascade')->onDelete('cascade'); 
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->string('universitas');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('surat_pengantar');
            $table->string('proposal');
            $table->string('cv');
            $table->string('vaksin');
            $table->timestamp('tgl_expired');
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
        Schema::dropIfExists('mahasiswa');
    }
};
