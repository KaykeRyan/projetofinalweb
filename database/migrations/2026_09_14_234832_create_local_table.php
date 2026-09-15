<?php
// database/migrations/xxxx_xx_xx_create_local_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('local', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloco_id')->constrained('bloco');
            $table->foreignId('tipo_local_id')->constrained('tipo_local');
            $table->string('nome', 100);
            $table->string('identificador', 50)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('local');
    }
};