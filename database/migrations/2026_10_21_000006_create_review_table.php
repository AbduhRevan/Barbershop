<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id('id_review');
            $table->foreignId('id_booking')->constrained('booking', 'id_booking');
            $table->unique('id_booking');
            $table->unsignedTinyInteger('rating');
            $table->text('ulasan')->nullable();
            $table->enum('status_moderasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->foreignId('dimoderasi_oleh')->nullable()->constrained('pengguna', 'id_pengguna');
            $table->timestamp('dibuat_pada')->useCurrent();
            $table->timestamp('dimoderasi_pada')->nullable();
        });
        DB::statement('ALTER TABLE review ADD CONSTRAINT cek_rating CHECK (rating BETWEEN 1 AND 5)');
    }

    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
