<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('token_usuario', function (Blueprint $table) {
            $table->renameColumn('valido ate', 'valido_ate');
        });
    }

    public function down(): void
    {
        Schema::table('token_usuario', function (Blueprint $table) {
            $table->renameColumn('valido_ate', 'valido ate');
        });
    }
};