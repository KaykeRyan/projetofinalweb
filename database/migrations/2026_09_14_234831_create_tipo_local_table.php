<?php
// database/migrations/xxxx_xx_xx_create_tipo_local_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_local', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_local');
    }
};