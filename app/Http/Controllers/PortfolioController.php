<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function index()
    {
        // Fetch the latest 4 transactions for the authenticated user
        $transactions = Transaction::where('user_id', Auth::id())->latest()->take(4)->get();
        
        // Pass transactions to the portfolio view
        return view('portfolio', compact('transactions'));
    }
}