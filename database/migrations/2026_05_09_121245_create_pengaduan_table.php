<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('kategori_id')
                ->constrained('kategori_pengaduan')
                ->cascadeOnDelete();

            $table->string('judul', 150);
            $table->text('isi_pengaduan');
            $table->string('lokasi', 255)->nullable();

            $table->enum('status', ['dikirim', 'diproses', 'selesai', 'ditolak'])
                ->default('dikirim');

            $table->text('catatan_rt')->nullable();

            $table->foreignId('diverifikasi_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('tanggal_verifikasi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};