<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('is_jobseeker');
    // }

    public function index()
    {
         /** @var \App\Models\User $user */
         $user = Auth::user();
         $user->load(['applications']);
        $stats = [
            'applications' => $user->applications()->count(),
            'pending' => $user->applications()->where('status', 'pending')->count(),
            'accepted' => $user->applications()->where('status', 'accepted')->count(),
            'rejected' => $user->applications()->where('status', 'rejected')->count(),
        ];

        $recentApplications = $user->applications()
            ->with('jobPost')
            ->latest()
            ->take(5)
            ->get();

        return view('jobseeker.dashboard', compact('stats', 'recentApplications'));
    
    }
}