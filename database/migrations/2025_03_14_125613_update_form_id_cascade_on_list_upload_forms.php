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
            //
            $table->dropForeign(['form_id']);

            // Tambahkan foreign key baru dengan cascade delete
            $table->foreign('form_id')
                  ->references('id')
                  ->on('forms')
                  ->onDelete('cascade'); // Menghapus otomatis data terkait
                  
            $table->char('is_required');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list_upload_forms', function (Blueprint $table) {
            $table->dropForeign(['is_required']);
            $table->dropForeign(['form_id']);

            // Tambahkan kembali foreign key tanpa cascade delete
            $table->foreign('form_id')
                  ->references('id')
                  ->on('forms');
        });
    }
};
