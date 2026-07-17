<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorite_recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('spoonacular_id');
            $table->string('title');
            $table->string('image_url')->nullable();
            $table->unsignedSmallInteger('ready_in_minutes')->nullable();
            $table->unsignedSmallInteger('servings')->nullable();
            $table->string('source_url')->nullable();
            $table->text('summary')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'spoonacular_id']);
            $table->index('spoonacular_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_recipes');
    }
};
