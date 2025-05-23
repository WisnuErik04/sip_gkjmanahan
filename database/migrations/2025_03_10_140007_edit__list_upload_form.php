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
        Schema::table('list_upload_forms', function (Blueprint $table) {
            // $table->dropColumn('order');
            $table->integer('order')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list_upload_forms', function (Blueprint $table) {
            // $table->integer('order');
        });
    }
};
