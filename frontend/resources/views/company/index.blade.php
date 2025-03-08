@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Data Company</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Create -->
    <a href="{{ route('company.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        + Tambah Company
    </a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nama Perusahaan</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-2 px-6">{{ $company['id'] }}</td>
                        <td class="py-2 px-6">{{ $company['name'] }}</td>
                        <td class="py-2 px-6">{{ $company['email'] }}</td>
                        <td class="py-2 px-6 flex space-x-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('company.edit', $company['id']) }}" 
                               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                ✏️ Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('company.destroy', $company['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
