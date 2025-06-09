<?php

  namespace App\Http\Controllers;

  use Illuminate\Support\Facades\Auth;
  use App\Models\Balance;
  use App\Models\Transaction;

  class WalletController extends Controller
  {
      public function index()
      {
          $balances = Balance::where('user_id', Auth::id())->with('asset')->get();
          $transactions = Transaction::where('user_id', Auth::id())
              ->with('asset')
              ->where('type', 'deposit')
              ->where('asset_id', function ($query) {
                  $query->select('id')->from('assets')->where('symbol', 'BTC');
              })
              ->latest()
              ->take(5)
              ->get();

          return view('wallet.index', compact('balances', 'transactions'));
      }
  }