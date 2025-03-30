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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();

            $table->string('pemohon_nama');
            $table->string('pemohon_hp_telepon');
            $table->string('pemohon_email');
            $table->string('pemohon_warga_blok');
            $table->text('pemohon_alamat');


            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('form_id')->constrained('forms');
            $table->foreignId('request_status_id')->constrained('request_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
