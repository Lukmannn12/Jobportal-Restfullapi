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
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://127.0.0.1:8000/api/applications');
        
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Gagal mengambil data lamaran.');
        }
    
        $applications = $response->json();
        return view('application.index', compact('applications'));
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

    public function edit($id)
    {
        $token = session('token'); // Ambil token dari session (jika diperlukan)
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("http://127.0.0.1:8000/api/applications/{$id}");
        
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Gagal mengambil data lamaran.');
        }

        $application = $response->json();
        return view('application.update', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $token = session('token'); // Ambil token dari session (jika diperlukan)
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put("http://127.0.0.1:8000/api/applications/{$id}", [
            'status' => $request->input('status'),
        ]);
        
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Gagal mengupdate status lamaran.');
        }

        return redirect()->route('application.index')->with('success', 'Status lamaran berhasil diupdate.');
    }
}
