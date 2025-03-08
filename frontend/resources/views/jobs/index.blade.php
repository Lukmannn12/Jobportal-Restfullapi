@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Pekerjaan</h1>
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
        <!-- Tombol Create Job -->
        <a href="{{ route('jobs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        + Tambah Pekerjaan
    </a>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Perusahaan</th>
                    <th class="py-3 px-6 text-left">Judul</th>
                    <th class="py-3 px-6 text-left">Deskripsi</th>
                    <th class="py-3 px-6 text-left">Lokasi</th>
                    <th class="py-3 px-6 text-left">Tipe</th>
                    <th class="py-3 px-6 text-left">Deadline</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-2 px-6">{{ $job['id'] }}</td>
                        <td class="py-2 px-6">{{ $job['company'] }}</td>
                        <td class="py-2 px-6 font-bold">{{ $job['title'] }}</td>
                        <td class="py-2 px-6">{{ Str::limit($job['description'], 50) }}</td>
                        <td class="py-2 px-6">{{ $job['location'] }}</td>
                        <td class="py-2 px-6 capitalize">{{ $job['job_type'] }}</td>
                        <td class="py-2 px-6">{{ \Carbon\Carbon::parse($job['deadline'])->format('d M Y') }}</td>
                        <td class="py-2 px-6">
                            <a href="" class="bg-yellow-500 text-white px-3 py-1 rounded">✏️ Edit</a>
                            <form action="" method="POST" class="inline">
                                <!-- @csrf
                                @method('DELETE') -->
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Hapus data ini?')">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
