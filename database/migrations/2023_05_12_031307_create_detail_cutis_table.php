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
        Schema::create('detail_cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('cuti_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('waktu_pengajuan');
            $table->text('keterangan')->nullable()->default(null);
            $table->enum('status', ['Diterima', 'Ditolak', 'Pengajuan'])->default('Pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_cutis');
    }
};
