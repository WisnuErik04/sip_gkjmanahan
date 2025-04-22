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
        Schema::table('form_pertanyaans', function (Blueprint $table) {
            $table->enum('tipe_jawaban', ['text', 'textarea', 'date', 'time', 'select', 'checkbox', 'radio', 'header'])->change();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('form_pertanyaans', function (Blueprint $table) {
            //
        });
    }
};
