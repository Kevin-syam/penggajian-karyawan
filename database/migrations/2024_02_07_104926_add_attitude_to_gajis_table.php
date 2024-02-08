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
        Schema::table('gajis', function (Blueprint $table) {
            //
            $table->integer('attitude');
            $table->integer('kinerja');
            $table->integer('kedisiplinan');
            $table->integer('efisiensi_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gajis', function (Blueprint $table) {
            //
            $table->dropColumn('attitude');
            $table->dropColumn('kinerja');
            $table->dropColumn('kedisiplinan');
            $table->dropColumn('efisiensi_kerja');
        });
    }
};
