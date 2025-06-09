<?php

  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Support\Facades\Schema;

  return new class extends Migration
  {
      public function up(): void
      {
          Schema::create('transactions', function (Blueprint $table) {
              $table->id();
              $table->foreignId('user_id')->constrained()->onDelete('cascade');
              $table->string('type');
              $table->foreignId('asset_id')->constrained()->onDelete('restrict');
              $table->decimal('amount', 18, 8);
              $table->string('status')->default('pending');
              $table->string('address')->nullable();
              $table->timestamps();
          });

          Schema::create('transaction_history', function (Blueprint $table) {
              $table->id();
              $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
              $table->decimal('amount', 18, 8);
              $table->string('type'); // 'credit' or 'debit'
              $table->timestamps();
          });
      }

      public function down(): void
      {
          Schema::dropIfExists('transaction_history');
          Schema::dropIfExists('transactions');
      }
  };