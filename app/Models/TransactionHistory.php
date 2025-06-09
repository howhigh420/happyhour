<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\HasMany;

  class Transaction extends Model
  {
      protected $fillable = [
          'user_id', 'asset_id', 'type', 'amount', 'status', 'address',
      ];

      public function user(): BelongsTo
      {
          return $this->belongsTo(User::class);
      }

      public function asset(): BelongsTo
      {
          return $this->belongsTo(Asset::class);
      }

      public function history(): HasMany
      {
          return $this->hasMany(TransactionHistory::class, 'transaction_id');
      }
  }