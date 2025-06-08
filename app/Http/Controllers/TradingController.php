<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TradingController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->take(5)->get();
        return view('trading.index', compact('transactions'));
    }

    public function placeTrade(Request $request)
    {
        $validated = $request->validate([
            'trade_type' => 'required|in:buy,sell',
            'asset' => 'required|string',
            'order_type' => 'required|in:market,limit,stop_loss,take_profit',
            'amount' => 'required|numeric|min:0.00000001',
            'price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'allocation' => 'required|integer|min:0|max:100',
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'asset' => $validated['asset'],
            'type' => $validated['trade_type'],
            'amount' => $validated['amount'],
            'value' => '$' . number_format($validated['total'], 2),
            'status' => 'pending',
        ]);

        // Update user balance (simplified)
        $user = Auth::user();
        if ($validated['trade_type'] === 'buy') {
            $user->balance -= $validated['total'];
        } else {
            $user->balance += $validated['total'];
        }
        $user->save();

        return redirect()->route('trading')->with('success', 'Trade placed successfully!');
    }
}