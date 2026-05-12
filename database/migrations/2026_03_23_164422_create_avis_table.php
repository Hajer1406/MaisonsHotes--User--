<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->id();

            // 🔗 Relations
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('maison_id')->constrained()->cascadeOnDelete();

            // 📝 Données
            $table->text('commentaire');
            $table->integer('note');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avis');
    }
};
