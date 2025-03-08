<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Panggil API untuk mendapatkan total companies
        $response = Http::get('http://127.0.0.1:8000/api/companies/total');

        // Ambil datanya jika berhasil
        $totalCompanies = $response->successful() ? $response->json()['total_companies'] : 0;

        // Kirimkan data ke view
        return view('dashboard', compact('totalCompanies'));
    }
}
