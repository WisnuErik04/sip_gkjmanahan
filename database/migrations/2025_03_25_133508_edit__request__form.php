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
        Schema::table('Requests', function (Blueprint $table) {
            $table->char('telah_dijadwalkan_sidang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Requests', function (Blueprint $table) {
            $table->dropColumn('telah_dijadwalkan_sidang');
        });
    }
};
