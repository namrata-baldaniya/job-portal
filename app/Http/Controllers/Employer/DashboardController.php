<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load(['jobPosts', 'companyProfile']);

        $stats = [
            'activeJobs' => $user->jobPosts->where('status', 'approved')->count(),
            'pendingApplications' => Application::whereIn('job_post_id', $user->jobPosts->pluck('id'))
                ->where('status', 'pending')
                ->count(),
            'totalViews' => $user->jobPosts->sum('views'),
            'companyName' => $user->companyProfile->company_name ?? 'Not Set'
        ];
        $recentApplications = Application::whereIn('job_post_id', $user->jobPosts->pluck('id'))
            ->with(['jobPost', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('employer.dashboard', compact('stats', 'recentApplications','user'));
    }
}