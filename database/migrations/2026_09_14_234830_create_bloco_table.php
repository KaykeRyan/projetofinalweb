<?php
// database/migrations/xxxx_xx_xx_create_bloco_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bloco', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('descricao', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bloco');
    }
};