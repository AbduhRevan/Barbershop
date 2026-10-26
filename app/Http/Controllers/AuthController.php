<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AuthController extends Controller
{
    /** Halaman tujuan setelah login, sesuai peran pengguna. */
    public static function tujuan(Pengguna $pengguna): string
    {
        return match ($pengguna->peran) {
            'admin' => route('admin.booking'),
            'owner' => route('owner.dashboard'),
            default => route('beranda'),
        };
    }

    public function formMasuk(): View
    {
        return view('auth.masuk');
    }

    public function masuk(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'kata_sandi' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Masukkan email yang valid.',
            'kata_sandi.required' => 'Kata sandi wajib diisi.',
        ]);

        if (! Auth::attempt(['email' => $data['email'], 'password' => $data['kata_sandi']])) {
            return back()
                ->withErrors(['email' => 'Email atau kata sandi salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(self::tujuan($request->user()));
    }

    public function formDaftar(): View
    {
        return view('auth.daftar');
    }

    public function daftar(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'nomor_whatsapp' => ['required', 'regex:/^\+?[0-9]{9,15}$/'],
            'email' => ['required', 'email', 'max:100', Rule::unique('pengguna', 'email')],
            'kata_sandi' => ['required', 'string', 'min:6'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',
            'nomor_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'nomor_whatsapp.regex' => 'Masukkan nomor WhatsApp berupa angka (9 sampai 15 digit).',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Masukkan email yang valid.',
            'email.unique' => 'Email sudah terdaftar. Silakan masuk.',
            'kata_sandi.required' => 'Kata sandi wajib diisi.',
            'kata_sandi.min' => 'Kata sandi minimal 6 karakter.',
        ]);

        Pengguna::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'nomor_whatsapp' => $data['nomor_whatsapp'],
            'kata_sandi' => $data['kata_sandi'],
            'peran' => 'pelanggan',
            'status_member' => 'non_member',
        ]);

        return redirect()->route('masuk')->with('sukses', 'Akun berhasil dibuat. Silakan masuk.');
    }

    public function keluar(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}
