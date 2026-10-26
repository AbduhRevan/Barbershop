<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('nomor_whatsapp', 20)->nullable();
            $table->string('kata_sandi', 255);
            $table->enum('peran', ['pelanggan', 'admin', 'owner']);
            $table->enum('status_member', ['member', 'non_member'])->default('non_member');
            $table->date('tanggal_mulai_member')->nullable();
            $table->date('tanggal_berakhir_member')->nullable();
            $table->timestamp('dibuat_pada')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
