@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Employer Dashboard</h1>
        <div class="dashboard-date">
            <span class="text-muted" id="current-date">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body bg-light">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-1">Welcome back, {{ $user->name }}!</h4>
                    <p class="mb-0 text-muted">
        @if($stats['companyName'] !== 'Not Set')
            {{ $stats['companyName'] }} | 
        @endif
        {{ $stats['activeJobs'] }} active job posts
    </p>
                    
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('employer.job_posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Post New Job
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Active Jobs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['activeJobs'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pending Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pendingApplications'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-start-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Views</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Recent Applications</h6>
            <a href="{{ route('employer.applications.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Job Title</th>
                            <th>Applicant</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentApplications as $application)
                        <tr>
                            <td>{{ $application->jobPost->title }}</td>
                            <td>{{ $application->user->name }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $application->status === 'accepted' ? 'success' : 
                                    ($application->status === 'rejected' ? 'danger' : 'warning') 
                                }}">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td>{{ $application->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('employer.applications.show', $application->id) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No applications yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('employer.job_posts.index') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-list me-2"></i> My Job Posts
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('employer.company_profile.edit') }}" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-building me-2"></i> Company Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .border-start-primary { border-left-color: #4e73df !important; }
    .border-start-success { border-left-color: #1cc88a !important; }
    .border-start-info { border-left-color: #36b9cc !important; }
    .card { border-radius: 0.35rem; }
    .table-hover tbody tr:hover { background-color: rgba(0,0,0,.02); }
    .badge { font-size: 0.85em; font-weight: 500; }
</style>
@endsection

@section('scripts')
<script>
    // Update current date in real-time
    function updateCurrentDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
    }
    
    updateCurrentDate();
    setInterval(updateCurrentDate, 60000);
</script>
@endsection
@endsection