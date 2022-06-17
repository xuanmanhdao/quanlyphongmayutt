<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class KiemTraDangNhapMiddleware
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
        // if(!session()->has('Quyen')){
        //     return redirect()->route('dangnhap');
        // }
        if (session()->get('Quyen') === 0 || session()->get('Quyen') === 1) {
            return $next($request);
        } else if (session()->get('Quyen') === 2) {
            return redirect()->route('dangnhap')->with('error', 'Tài khoản của bạn đã bị khóa');
        } else {
            return redirect()->route('dangnhap');
        }
    }
}
