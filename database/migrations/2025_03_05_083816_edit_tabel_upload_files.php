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
        Schema::table('upload_files', function (Blueprint $table) {
            $table->string('file_path'); // Path file di storage
            $table->string('file_name'); // Nama asli file
            $table->string('file_type'); // Jenis file (pdf, jpg, dll)
            $table->integer('file_size'); // Ukuran file dalam KB
            $table->dropColumn('name');
            $table->dropColumn('directory');
            $table->dropColumn('extension');
            $table->dropColumn('label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upload_files', function (Blueprint $table) {
            $table->string('name'); // Path file di storage
            $table->string('directory'); // Nama asli file
            $table->string('extension'); // Jenis file (pdf, jpg, dll)
            $table->string('label'); // Ukuran file dalam KB
            $table->dropColumn('file_path');
            $table->dropColumn('file_name');
            $table->dropColumn('file_type');
            $table->dropColumn('file_size');
        });
    }
};
