<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        try {
            $userId = Auth::id();

            if (!$userId) {
                return response()->json([
                    'message' => 'User harus login dulu'
                ], 401);
            }

            $applications = Application::with(['user:id,name', 'job:id,title'])
                ->where('user_id', $userId)
                ->get()
                ->map(function ($application) {
                    return [
                        'id' => $application->id,
                        'user' => $application->user->name ?? 'Unknown',
                        'job' => $application->job->title ?? 'Unknown',
                        'cover_letter' => $application->cover_letter,
                        'status' => $application->status,
                        'created_at' => $application->created_at,
                        'updated_at' => $application->updated_at,
                    ];
                });

            return response()->json($applications);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan pada server',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
{
    try {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'message' => 'User harus login dulu'
            ], 401);
        }

        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $application = Application::create([
            'user_id' => $userId,
            'job_id' => $request->job_id,
            'cover_letter' => $request->cover_letter,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Lamaran berhasil dikirim',
            'application' => $application
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Terjadi kesalahan pada server',
            'message' => $e->getMessage(),
        ], 500);
    }
}

}

