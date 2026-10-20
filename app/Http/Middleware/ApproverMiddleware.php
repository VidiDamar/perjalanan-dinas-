<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApproverMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Mengecek apakah user sudah login dan memiliki role 'atasan' atau 'approver'
        if (auth()->check() && in_array(auth()->user()->role, ['atasan', 'approver', 'admin'])) {
            return $next($request);
        }

        abort(403, 'Akses Ditolak: Anda tidak memiliki hak akses sebagai Atasan/Approver.');
    }
}
