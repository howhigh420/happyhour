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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('asset_id')->constrained();
            $table->decimal('amount', 18, 8)->default(0);
            $table->timestamps();
        });
        
        Schema::create('balance_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balance_id')->constrained('balances');
            $table->decimal('amount', 18, 8);
            $table->string('type'); // 'credit' or 'debit'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
