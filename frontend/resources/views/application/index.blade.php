@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Lamaran Pekerjaan</h1>

<div class="bg-white p-6 rounded-lg shadow-md">
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">User</th>
                <th class="border p-2">Job</th>
                <th class="border p-2">Surat Lamaran</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Dibuat Pada</th>
                <th class="border p-2">Diupdate Pada</th>
                <th class="border p-2">Aksi</th> <!-- Kolom baru untuk tombol -->
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
            <tr>
                <td class="border p-2">{{ $application['id'] }}</td>
                <td class="border p-2">{{ $application['user'] }}</td>
                <td class="border p-2">{{ $application['job'] }}</td>
                <td class="border p-2">{{ $application['cover_letter'] }}</td>
                <td class="border p-2">{{ $application['status'] }}</td>
                <td class="border p-2">{{ $application['created_at'] }}</td>
                <td class="border p-2">{{ $application['updated_at'] }}</td>
                <td class="border p-2">
                    <!-- Tombol Update Status -->
                    <a href="{{ route('application.edit', $application['id']) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Update Status
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection