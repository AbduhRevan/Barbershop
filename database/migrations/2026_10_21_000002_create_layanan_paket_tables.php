<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_layanan', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 50)->unique();
        });

        Schema::create('layanan', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->foreignId('id_kategori')->constrained('kategori_layanan', 'id_kategori');
            $table->string('nama_layanan', 100);
            $table->text('deskripsi')->nullable();
            $table->enum('jenis_staf', ['capster', 'terapis']);
            $table->enum('syarat_staf', ['umum', 'khusus_terapis_wanita'])->default('umum');
            $table->unsignedInteger('durasi_menit');
            $table->decimal('harga_member', 12, 2);
            $table->decimal('harga_non_member', 12, 2);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        });

        Schema::create('paket', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket', 50)->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_member', 12, 2);
            $table->decimal('harga_non_member', 12, 2);
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        });

        Schema::create('detail_paket', function (Blueprint $table) {
            $table->foreignId('id_paket')->constrained('paket', 'id_paket')->cascadeOnDelete();
            $table->foreignId('id_layanan')->constrained('layanan', 'id_layanan')->cascadeOnDelete();
            $table->primary(['id_paket', 'id_layanan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_paket');
        Schema::dropIfExists('paket');
        Schema::dropIfExists('layanan');
        Schema::dropIfExists('kategori_layanan');
    }
};
