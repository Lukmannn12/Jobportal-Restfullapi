<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApplicationController extends Controller
{

    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/jobs');
        $jobs = $response->json();

        return view('welcome', compact('jobs'));
    }

public function apply(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    dd(Auth::user()); // Debug user yang sedang login

    $data = [
        'user_id' => Auth::id(),
        'job_id' => $request->job_id,
        'cover_letter' => "Saya sangat tertarik dengan posisi ini."
    ];

    $response = Http::withToken(session('token'))->post('http://127.0.0.1:8000/api/applications', $data);

    return $response->successful()
        ? redirect()->back()->with('success', 'Lamaran berhasil dikirim!')
        : redirect()->back()->with('error', 'Gagal mengirim lamaran.');
}

}
