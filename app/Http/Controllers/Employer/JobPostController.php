<?php

namespace App\Http\Controllers\Employer;

use App\Models\JobPost;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load(['jobPosts', 'companyProfile']);

        $jobPosts = $user->jobPosts()
        ->withCount('applications') 
        ->latest()
        ->get();
        // $jobPosts = $user->jobPosts()->latest()->get();
        return view('employer.job_posts.index', compact('jobPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.job_posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
            'salary' => 'nullable|numeric',
            'deadline' => 'required|date|after:today',
        ]);
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $user->load(['jobPosts', 'companyProfile']);
        $user->jobPosts()->create($validated);

        return redirect()->route('employer.job_posts.index')
            ->with('success', 'Job post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        $this->authorize('view', $jobPost);
        return view('employer.job_posts.show', compact('jobPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $jobPost)
    {
        $this->authorize('update', $jobPost);
        return view('employer.job_posts.edit', compact('jobPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobPost $jobPost)
    {
        $this->authorize('update', $jobPost);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'location' => 'required|string',
            'salary' => 'nullable|numeric',
            'deadline' => 'required|date|after:today',
            'status' => 'sometimes|in:pending,approved,rejected'
        ]);

        $jobPost->update($validated);

        return redirect()->route('employer.job_posts.index')
            ->with('success', 'Job post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $jobPost)
    {
        $this->authorize('delete', $jobPost);
        $jobPost->delete();
        return redirect()->route('employer.job_posts.index')
            ->with('success', 'Job post deleted successfully!');
    }
}
