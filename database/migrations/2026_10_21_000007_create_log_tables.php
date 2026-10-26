<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_status_booking', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->foreignId('id_booking')->constrained('booking', 'id_booking');
            $table->string('status_lama', 30)->nullable();
            $table->string('status_baru', 30);
            $table->foreignId('diubah_oleh')->nullable()->constrained('pengguna', 'id_pengguna');
            $table->timestamp('waktu_perubahan')->useCurrent();
        });

        Schema::create('log_notifikasi', function (Blueprint $table) {
            $table->id('id_log');
            $table->foreignId('id_booking')->constrained('booking', 'id_booking');
            $table->foreignId('id_admin')->constrained('pengguna', 'id_pengguna');
            $table->enum('jenis_pesan', ['disetujui', 'ditolak', 'jadwal_ulang', 'dibatalkan']);
            $table->text('isi_pesan');
            $table->string('nomor_tujuan', 20);
            $table->timestamp('waktu_disusun')->useCurrent();
            $table->timestamp('waktu_dibuka')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_notifikasi');
        Schema::dropIfExists('riwayat_status_booking');
    }
};
