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
        Schema::table('durasi', function (Blueprint $table) {
            $table->integer('limit')->after('waktu_durasi');
            $table->enum('pendidikan', ['siswa', 'mahasiswa'])->after('limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('durasi', function (Blueprint $table) {
            $table->dropColumn('pendidikan');
            $table->dropColumn('limit');
        });
    }
};
