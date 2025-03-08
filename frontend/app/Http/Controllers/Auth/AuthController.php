<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        if ($response->successful()) {
            $data = $response->json(); // Ambil token dari response
    
            if (!isset($data['token'])) {
                return back()->withErrors(['email' => 'Login gagal, token tidak ditemukan']);
            }
    
            // Gunakan token untuk mengambil data user yang login
            $userResponse = Http::withToken($data['token'])->get('http://127.0.0.1:8000/api/user');
    
            if ($userResponse->successful()) {
                $user = $userResponse->json();
    
                // Simpan user dan token dalam session Laravel
                session([
                    'user' => $user,
                    'token' => $data['token'],
                ]);
    
                session()->save(); // Pastikan session tersimpan
    
                // Cek role user
                if ($user['role'] === 'admin') {
                    return redirect('/dashboard')->with('success', 'Login berhasil sebagai Admin');
                } else {
                    return redirect('/')->with('success', 'Login berhasil sebagai User');
                }
            } else {
                return back()->withErrors(['email' => 'Gagal mengambil data user']);
            }
        }
    
        return back()->withErrors(['email' => 'Email atau password salah']);
    }
    
        
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            return redirect('/login')->with('success', 'Registrasi berhasil');
        }

        return back()->withErrors(['email' => 'Gagal registrasi, periksa kembali data Anda']);
    }

    public function logout(Request $request)
{
    // Hapus session user dan token
    session()->forget(['user', 'token']);

    // Redirect ke halaman login dengan pesan sukses
    return redirect('/login')->with('success', 'Logout berhasil');
}

}
