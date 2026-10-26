<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('id_pelanggan')->nullable()->constrained('pengguna', 'id_pengguna');
            $table->foreignId('id_paket')->nullable()->constrained('paket', 'id_paket');
            $table->enum('sumber', ['online', 'walk_in']);
            $table->date('tanggal_layanan');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status', [
                'menunggu_persetujuan',
                'disetujui',
                'ditolak',
                'menunggu_konfirmasi',
                'perlu_dijadwalkan_ulang',
                'dibatalkan',
                'selesai',
            ]);
            $table->string('alasan', 255)->nullable();
            $table->date('tanggal_lama')->nullable();
            $table->time('jam_mulai_lama')->nullable();
            $table->dateTime('batas_konfirmasi')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
        });

        Schema::create('segmen_booking', function (Blueprint $table) {
            $table->id('id_segmen');
            $table->foreignId('id_booking')->constrained('booking', 'id_booking');
            $table->unsignedTinyInteger('urutan');
            $table->enum('jenis_staf', ['capster', 'terapis']);
            $table->foreignId('id_staf')->constrained('staf', 'id_staf');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unique(['id_booking', 'urutan']);
        });

        Schema::create('detail_booking', function (Blueprint $table) {
            $table->id('id_detail_booking');
            $table->foreignId('id_segmen')->constrained('segmen_booking', 'id_segmen');
            $table->foreignId('id_layanan')->constrained('layanan', 'id_layanan');
            $table->unsignedInteger('durasi_menit');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_booking');
        Schema::dropIfExists('segmen_booking');
        Schema::dropIfExists('booking');
    }
};
