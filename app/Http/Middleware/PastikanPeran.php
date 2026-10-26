<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PastikanPeran
{
    /**
     * Hanya izinkan pengguna dengan salah satu peran yang disebut pada rute.
     * Contoh pemakaian: ->middleware('peran:admin') atau ->middleware('peran:admin,owner')
     */
    public function handle(Request $request, Closure $next, string ...$peran): Response
    {
        $pengguna = $request->user();

        if (! $pengguna || ! in_array($pengguna->peran, $peran, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
