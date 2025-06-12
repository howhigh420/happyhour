<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('IsAdmin Middleware', [
            'user_id' => Auth::id(),
            'is_authenticated' => Auth::check(),
            'is_admin' => Auth::user()->is_admin ?? false,
            'request_path' => $request->path(),
        ]);

        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        Log::warning('Admin access denied', ['user_id' => Auth::id()]);
        return redirect('/dashboard')->with('error', 'Unauthorized access.');
    }
}
?>