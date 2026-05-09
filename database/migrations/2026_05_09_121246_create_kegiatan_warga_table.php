<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan_warga', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 150);
            $table->text('deskripsi');
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('lokasi', 255)->nullable();

            $table->foreignId('dibuat_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_warga');
    }
};