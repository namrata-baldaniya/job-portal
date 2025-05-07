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
}