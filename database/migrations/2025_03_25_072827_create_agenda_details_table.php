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
        Schema::create('agenda_details', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->string('perihal');
            $table->string('dari');
            $table->date('tanggal_masuk');
            $table->text('usulan_keputusan')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('agenda_id')->constrained('agendas');
            $table->foreignId('jenis_id')->constrained('agenda_jenis');
            $table->foreignId('keterangan_id')->constrained('agenda_keterangans');
            $table->foreignId('request_id')->nullable()->constrained('requests')->nullOnDelete(); // Foreign key nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_details');
    }
};
