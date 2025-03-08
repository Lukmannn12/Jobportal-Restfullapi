@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Company</h1>

    <form action="{{ route('company.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nama Perusahaan</label>
            <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Simpan
        </button>
    </form>
@endsection
