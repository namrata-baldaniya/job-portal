<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load(['applications']);

        $applications = $user->applications()->with('jobPost')->latest()->get();
        return view('jobseeker.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->resume) {
            return redirect()->route('jobseeker.resume.create')
                ->with('warning', 'Please upload your resume before applying for jobs.');
        }

        return view('jobseeker.applications.create', compact('jobPost'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, JobPost $jobPost)
    {
        $request->validate([
            'cover_letter' => 'required|string',
        ]);

        Application::create([
            'job_post_id' => $jobPost->id,
            'user_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->route('jobseeker.applications.index')
            ->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $this->authorize('view', $application);
        
        return view('jobseeker.applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
