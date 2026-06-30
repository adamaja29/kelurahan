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
        Schema::create('surat_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnDelete();
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->cascadeOnDelete();

            $table->foreignId('surat_pengantar_id')->nullable()->constrained('surat_pengantar')->nullOnDelete();

            $table->string('nomor_surat')->nullable();

            $table->enum('status', [
                'menunggu_admin',
                'ditolak_admin',
                'menunggu_lurah',
                'ditolak_lurah',
                'selesai'
            ])->default('menunggu_admin');

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
        Schema::dropIfExists('surat_kelurahan');
    }
};
