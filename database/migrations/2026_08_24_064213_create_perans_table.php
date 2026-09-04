<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('film_id')
                  ->constrained('film')
                  ->cascadeOnDelete();

            $table->foreignId('cast_id')
                  ->constrained('cast')
                  ->cascadeOnDelete();

            $table->string('nama', 45);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peran');
    }
};