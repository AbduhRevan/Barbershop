<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_booking')->constrained('booking', 'id_booking');
            $table->unique('id_booking');
            $table->foreignId('id_admin')->constrained('pengguna', 'id_pengguna');
            $table->string('metode_pembayaran', 30);
            $table->enum('status_member', ['member', 'non_member']);
            $table->decimal('total_harga', 12, 2);
            $table->timestamp('waktu_transaksi')->useCurrent();
        });

        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('id_detail_transaksi');
            $table->foreignId('id_transaksi')->constrained('transaksi', 'id_transaksi');
            $table->foreignId('id_layanan')->nullable()->constrained('layanan', 'id_layanan');
            $table->foreignId('id_paket')->nullable()->constrained('paket', 'id_paket');
            $table->string('nama_item', 100);
            $table->decimal('harga', 12, 2);
        });
        DB::statement('ALTER TABLE detail_transaksi ADD CONSTRAINT cek_item CHECK ((id_layanan IS NOT NULL AND id_paket IS NULL) OR (id_layanan IS NULL AND id_paket IS NOT NULL))');
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
        Schema::dropIfExists('transaksi');
    }
};
