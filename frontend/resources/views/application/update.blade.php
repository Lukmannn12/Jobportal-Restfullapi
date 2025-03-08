@extends('layouts.dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-4">Update Status Lamaran</h1>

<div class="bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('application.update', $application['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                <option value="pending" {{ $application['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accepted" {{ $application['status'] == 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="rejected" {{ $application['status'] == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            Update Status
        </button>
    </form>
</div>
@endsection