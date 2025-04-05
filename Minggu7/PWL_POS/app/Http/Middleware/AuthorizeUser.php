<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // praktikum 2, js 7
    // public function handle(Request $request, Closure $next, $role = ''): Response
    // {
    //     $user = $request->user();

    //     if($user->hasRole($role)) {
    //         return $next($request);
    //     }

    //     abort(403, 'Forbidden. kamu tidak punya akses ke halaman ini');
    // }

    // praktikum 3, js 7
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user_role = $request->user()->getRole();  // ambil data level_kode dari user yg login
        if (in_array($user_role, $roles)) {  // cek apakah level_kode user ada di dalam array roles
            return $next($request); // jika ada, maka lanjutkan request
        }
        // jika tidak punya role, maka tampilkan error 403
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}
