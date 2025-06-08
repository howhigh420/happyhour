<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 16, 2)->nullable();
            $table->decimal('portfolio_value', 16, 2)->nullable();
            $table->integer('active_positions')->nullable();
            $table->decimal('return_rate', 8, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['balance', 'portfolio_value', 'active_positions', 'return_rate']);
        });
    }
};