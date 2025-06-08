<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Balance;

class PortfolioController extends Controller
{
    public function index()
    {
        $balances = Balance::where('user_id', Auth::id())->with('asset')->get();
        return view('portfolio', compact('balances'));
    }
}