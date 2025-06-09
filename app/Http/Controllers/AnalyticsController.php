<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Balance;
use App\Models\Transaction;
use App\Models\Asset;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $balances = Balance::where('user_id', $user->id)->with('asset')->get();
        
        // Calculate total balance
        $totalBalance = $balances->sum(function ($balance) {
            // Placeholder: Assume USD equivalent (fetch real-time prices via CoinGecko if needed)
            return $balance->amount * ($balance->asset->symbol === 'USD' ? 1 : 1); // Adjust with real prices
        });

        // Transaction trends (last 30 days)
        $transactions = Transaction::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->with('asset')
            ->get();

        $transactionVolume = $transactions->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        })->map(function ($group) {
            return $group->sum('amount');
        });

        // Asset allocation
        $assetAllocation = $balances->mapWithKeys(function ($balance) {
            return [$balance->asset->symbol => $balance->amount];
        });

        // Recent activity
        $recentTransactions = Transaction::where('user_id', $user->id)
            ->with('asset')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('analytics.index', compact(
            'totalBalance',
            'transactionVolume',
            'assetAllocation',
            'recentTransactions',
            'balances'
        ));
    }
}