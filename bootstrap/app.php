<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\PastikanPeran;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'peran' => PastikanPeran::class,
        ]);

        // Tamu yang membuka halaman terlindungi diarahkan ke halaman masuk.
        $middleware->redirectGuestsTo(fn() => route('masuk'));

        // Pengguna yang sudah login dan membuka halaman masuk atau daftar diarahkan sesuai perannya.
        $middleware->redirectUsersTo(fn(Request $request) => AuthController::tujuan($request->user()));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
