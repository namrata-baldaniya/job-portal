@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Job Seeker Dashboard</h1>
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

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['applications'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Accepted</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['accepted'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Rejected</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['rejected'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Recent Applications</h6>
            <a href="{{ route('jobseeker.applications.index') }}" class="btn btn-sm btn-outline-primary">
                View All
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentApplications as $application)
                        <tr>
                            <td>{{ $application->jobPost->title }}</td>
                            <td>{{ $application->jobPost->user->companyProfile->company_name ?? 'N/A' }}</td>
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
                                <a href="{{ route('jobseeker.applications.show', $application) }}" 
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
                            <a href="{{ route('jobseeker.jobs.index') }}" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-search me-2"></i> Browse Jobs
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            @if(Auth::user()->resume)
                                <a href="{{ route('jobseeker.resume.index') }}" class="btn btn-outline-secondary btn-block">
                                    <i class="fas fa-file-alt me-2"></i> My Resume
                                </a>
                            @else
                                <a href="{{ route('jobseeker.resume.create') }}" class="btn btn-outline-danger btn-block">
                                    <i class="fas fa-exclamation-circle me-2"></i> Upload Resume
                                </a>
                            @endif
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
    .border-start-warning { border-left-color: #f6c23e !important; }
    .border-start-danger { border-left-color: #e74a3b !important; }
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