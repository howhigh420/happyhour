<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', Auth::id())
            ->with('asset')
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('asset')) {
            $query->whereHas('asset', function ($q) use ($request) {
                $q->where('symbol', $request->asset);
            });
        }
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->paginate(20);
        $assets = \App\Models\Asset::all();

        return view('history.index', compact('transactions', 'assets'));
    }
    public function export(Request $request)
    {
        // Add your export logic here, e.g., generating a CSV or Excel file
        // For example, using the Maatwebsite\Excel package:
        // return Excel::download(new TransactionsExport, 'transactions.csv');
        
        return response()->download('path/to/file.csv', 'transactions.csv');
    }
}