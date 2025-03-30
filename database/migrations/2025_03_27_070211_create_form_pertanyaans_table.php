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
        Schema::create('form_pertanyaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade');
            $table->string('pertanyaan');
            $table->enum('tipe_jawaban', ['text', 'textarea', 'select', 'checkbox', 'radio', 'header']);
            $table->json('opsi_jawaban')->nullable(); // Untuk select, checkbox, radio
            $table->boolean('required')->default(true);
            $table->integer('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_pertanyaans');
    }
};
