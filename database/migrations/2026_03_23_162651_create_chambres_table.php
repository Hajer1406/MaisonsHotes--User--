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
    Schema::create('chambres', function (Blueprint $table) {
        $table->id();

        $table->string('type');
        $table->float('prix');
        $table->boolean('disponible')->default(true);

        // ✅ clé étrangère vers maisons
        $table->foreignId('maison_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chambres');
    }
};
