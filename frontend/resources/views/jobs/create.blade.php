@extends('layouts.dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Pekerjaan</h1>

        <form action="{{ route('jobs.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Perusahaan -->
                <div>
                    <label class="block text-gray-700 font-medium">Nama Perusahaan</label>
                    <select name="company_id" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach($companies as $company)
                        <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Judul Pekerjaan -->
                <div>
                    <label class="block text-gray-700 font-medium">Judul Pekerjaan</label>
                    <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block text-gray-700 font-medium">Lokasi</label>
                    <input type="text" name="location" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Tipe Pekerjaan -->
                <div>
                    <label class="block text-gray-700 font-medium">Tipe Pekerjaan</label>
                    <select name="job_type" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200" required>
                        <option value="">-- Pilih Tipe Pekerjaan --</option>
                        <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="remote" {{ old('job_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                        <option value="internship" {{ old('job_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-gray-700 font-medium">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200" required></textarea>
            </div>

            <!-- Deadline -->
            <div>
                <label class="block text-gray-700 font-medium">Deadline</label>
                <input type="date" name="deadline" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200" required>
            </div>

            <!-- Tombol Simpan -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection