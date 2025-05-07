<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobPost::where('status', 'approved')
            ->with('user.companyProfile')
            ->latest()
            ->paginate(10);

        return view('jobseeker.jobs.index', compact('jobs'));
    }
    public function show(JobPost $jobPost)
    {
        if ($jobPost->status !== 'approved') {
            abort(404);
        }

        return view('jobseeker.jobs.show', compact('jobPost'));
    }
}
