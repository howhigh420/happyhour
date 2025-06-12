<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Asset;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'transactions' => Transaction::count(),
            'orders' => Order::count(),
            'assets' => Asset::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}