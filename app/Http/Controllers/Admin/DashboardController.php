<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {
        $stats = [
            'pendingJobs' => JobPost::where('status', 'pending')->count(),
            'employers' => User::where('role', 'employer')->count(),
            'jobSeekers' => User::where('role', 'jobseeker')->count(),
            'activeJobs' => JobPost::where('status', 'approved')->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }
    public function pending()
    {
        $pendingJobs = JobPost::where('status', 'pending')->get();
        
        return view('admin.jobs.pending', compact('pendingJobs'));
    }

    public function approve(JobPost $job)
    {
        $job->status = 'approved';
        $job->save();

        return redirect()->route('admin.jobs.pending')->with('status', 'Job approved successfully!');
    }

    public function reject(JobPost $job)
    {
        $job->status = 'rejected';
        $job->save();

        return redirect()->route('admin.jobs.pending')->with('status', 'Job rejected successfully!');
    }
}