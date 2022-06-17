<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;


class KiemTraQuyenAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('Quyen') !== 0) {
            // return redirect()->back()->with('success', 'Bạn không đủ quyền để thực hiện thao tác này');
            throw new Exception("Bạn không đủ quyền để thực hiện thao tác này");
        }
        return $next($request);
    }
}
