<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('http://127.0.0.1:8000/api/jobs');
        $jobs = $response->json();

        return view('jobs.index', compact('jobs'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data perusahaan dari API
        $response = Http::get('http://127.0.0.1:8000/api/companies'); // Sesuaikan URL API-mu
        $companies = $response->json(); // Ubah JSON response jadi array
    
        return view('jobs.create', compact('companies'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim
    $request->validate([
        'company_id' => 'required|exists:companies,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string',
        'job_type' => 'required|in:full-time,part-time,remote,internship',
        'deadline' => 'required|date'
    ]);

    // Kirim data ke API
    $response = Http::post('http://127.0.0.1:8000/api/jobs', [
        'company_id' => $request->company_id,
        'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'job_type' => $request->job_type,
        'deadline' => $request->deadline,
    ]);

    // Cek apakah request berhasil
    if ($response->successful()) {
        return redirect()->route('jobs.index')->with('success', 'Pekerjaan berhasil ditambahkan!');
    } else {
        return back()->with('error', 'Gagal menambahkan pekerjaan. Coba lagi.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
