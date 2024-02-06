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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('departemen_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nip');
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->date('waktu_masuk');
            $table->string('jabatan');
            $table->unsignedInteger('gaji');
            $table->string('bpjs_k', 11)->nullable()->default(null);
            $table->string('bpjs_tk', 11)->nullable()->default(null);
            $table->string('pajak', 20)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
