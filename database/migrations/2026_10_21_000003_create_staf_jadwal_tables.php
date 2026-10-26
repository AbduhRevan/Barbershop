<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staf', function (Blueprint $table) {
            $table->id('id_staf');
            $table->string('nama_staf', 100);
            $table->enum('jenis_staf', ['capster', 'terapis']);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('spesialisasi', 100)->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        });

        Schema::create('jadwal_kerja', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_staf')->constrained('staf', 'id_staf')->cascadeOnDelete();
            $table->unsignedTinyInteger('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
        });
        DB::statement('ALTER TABLE jadwal_kerja ADD CONSTRAINT cek_hari CHECK (hari BETWEEN 1 AND 7)');

        Schema::create('libur_staf', function (Blueprint $table) {
            $table->id('id_libur');
            $table->foreignId('id_staf')->constrained('staf', 'id_staf')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('keterangan', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libur_staf');
        Schema::dropIfExists('jadwal_kerja');
        Schema::dropIfExists('staf');
    }
};
