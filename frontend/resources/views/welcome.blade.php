@extends('layouts.main')

@section('content')
<h2 class="text-xl font-semibold mb-4">Available Jobs</h2>

@if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach($jobs as $job)
    <div class="bg-white p-6 shadow-md rounded-lg border">
        <h3 class="text-lg font-bold text-blue-600">{{ $job['title'] }}</h3>
        <p class="text-gray-700"><strong>Company:</strong> {{ $job['company'] }}</p>
        <p class="text-gray-600"><strong>Location:</strong> {{ $job['location'] }}</p>
        <p class="text-gray-600"><strong>Type:</strong> {{ ucfirst($job['job_type']) }}</p>
        <p class="text-gray-600"><strong>Deadline:</strong> {{ date('d M Y', strtotime($job['deadline'])) }}</p>
        <p class="text-gray-500 mt-2">{{ Str::limit($job['description'], 100) }}</p>

        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 apply-job"
            data-job-id="{{ $job['id'] }}">
            Apply
        </button>
    </div>
@endforeach
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.apply-job').forEach(button => {
            button.addEventListener('click', function () {
                let jobId = this.getAttribute('data-job-id');

                fetch("http://127.0.0.1:8000/api/applications", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": "Bearer {{ session('token') }}" // Gunakan token dari session
                    },
                    body: JSON.stringify({
                        job_id: jobId,
                        cover_letter: "Saya sangat tertarik dengan posisi ini.",
                        status: "pending"
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert("Gagal mengirim lamaran.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
@endsection
