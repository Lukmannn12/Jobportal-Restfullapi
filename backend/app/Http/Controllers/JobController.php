<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::with('company:id,name')->get()->map(function ($job) {
            return [
                'id' => $job->id,
                'company' => $job->company->name,
                'title' => $job->title,
                'description' => $job->description,
                'location' => $job->location,
                'job_type' => $job->job_type,
                'deadline' => $job->deadline,
                'created_at' => $job->created_at,
                'updated_at' => $job->updated_at,
            ];
        });
    
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'job_type' => 'required|in:full-time,part-time,remote,internship',
            'deadline' => 'required|date'
        ]);

        $job = Job::create($request->all());

        return response()->json([
            'message' => 'Job created successfully',
            'job' => $job
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
