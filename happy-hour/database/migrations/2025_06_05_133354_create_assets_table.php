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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->timestamps();
        });
        Schema::create('asset_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets');
            $table->decimal('price', 18, 8);
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
        });
        Schema::create('asset_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('asset_id')->constrained();
            $table->decimal('amount', 18, 8)->default(0);
            $table->timestamps();
        });
        Schema::create('asset_balance_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_balance_id')->constrained('asset_balances');
            $table->decimal('amount', 18, 8);
            $table->string('type'); // 'credit' or 'debit'
            $table->timestamps();
        });
        Schema::create('asset_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('type'); // 'buy' or 'sell'
            $table->foreignId('asset_id')->constrained();
            $table->decimal('amount', 18, 8);
            $table->decimal('price', 18, 8);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
        Schema::create('asset_transaction_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_transaction_id')->constrained('asset_transactions');
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
        Schema::dropIfExists('assets');
    }
};
