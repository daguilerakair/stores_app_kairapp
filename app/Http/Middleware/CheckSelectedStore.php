<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSelectedStore
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $selectedStore = session('selectedStore');
        // dd($selectedStore);
        if (!$selectedStore) {
            return $next($request);
        }

        return redirect('dashboard');
    }
}
