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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('mahasiswa_id')->nullable()->after('id')->constrained('mahasiswa', 'id')->onDelete('set null');
            $table->foreignId('siswa_id')->nullable()->after('id')->constrained('siswa', 'id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('siswa_id');
            $table->dropColumn('mahasiswa_id');
        });
    }
};