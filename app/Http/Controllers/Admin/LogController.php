<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function index()
    {
        $logFile = storage_path('logs/laravel.log');
        $logs = File::exists($logFile) ? File::lines($logFile)->take(-100)->reverse()->toArray() : [];

        return view('admin.logs.index', compact('logs'));
    }
}