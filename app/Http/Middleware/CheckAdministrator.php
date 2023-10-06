<?php

namespace App\Http\Middleware;

use App\Models\UserStore;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $store = session('store');
        $user = auth()->user();

        $userStore = UserStore::where('user_id', $user->id)->where('store_rut', $store->rut)->where('role_id', 1)->first();

        if (auth()->check() && $userStore) {
            return $next($request);
        }

        return redirect('dashboard');
    }
}
