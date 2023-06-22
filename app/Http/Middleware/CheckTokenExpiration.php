<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;

class CheckTokenExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $token = $request->user()->token(); // Lấy token của người dùng

        // Kiểm tra nếu token tồn tại và đã hết hạn
        if ($token && $token->expires_at <= Carbon::now()) {
            return response()->json(['message' => 'Token has expired.'], 401);
        }
        return  $next($request);
    }
}
