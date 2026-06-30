<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_pengantar', function (Blueprint $table) {
            $table->id();

            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();

            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->cascadeOnDelete();

            $table->string('nomor_surat')->nullable();

            $table->text('keperluan');

            $table->enum('status', [
                'menunggu_rt',
                'ditolak_rt',
                'menunggu_rw',
                'ditolak_rw',
                'selesai'
            ])->default('menunggu_rt');

            $table->text('catatan')->nullable();
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pengantar');
    }
};
