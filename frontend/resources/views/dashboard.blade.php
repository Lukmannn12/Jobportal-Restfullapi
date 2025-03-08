@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Welcome to Admin Dashboard</h2>
    
    @if(session()->has('user'))
        <p class="text-gray-700">Selamat datang, <strong>{{ session('user')['name'] }}</strong>!</p>
    @else
        <p class="text-red-500">Sesi tidak ditemukan. Silakan login lagi.</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow">
            <h4 class="text-xl font-semibold">Total Users</h4>
            <p class="text-lg">150</p>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-lg shadow">
            <h4 class="text-xl font-semibold">Total Jobs</h4>
            <p class="text-lg">35</p>
        </div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow">
            <h4 class="text-xl font-semibold">Total Company</h4>
            <p class="text-lg">{{ $totalCompanies }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow">
            <h4 class="text-xl font-semibold">Total Application</h4>
            <p class="text-lg">12</p>
        </div>
    </div>
</div>
@endsection
