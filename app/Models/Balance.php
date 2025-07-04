<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class Balance extends Model
  {
      protected $fillable = ['user_id', 'asset_id', 'amount'];

      public function asset()
      {
          return $this->belongsTo(Asset::class);
      }

      public function user()
      {
          return $this->belongsTo(User::class);
      }
  }