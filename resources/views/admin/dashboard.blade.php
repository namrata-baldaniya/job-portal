@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Admin Dashboard</h1>
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

    <!-- Stats Cards Row -->
    <div class="row mb-4">
        @php
            $cards = [
                ['label' => 'Pending Jobs', 'count' => $stats['pendingJobs'], 'class' => 'primary', 'icon' => 'clock'],
                ['label' => 'Employers', 'count' => $stats['employers'], 'class' => 'success', 'icon' => 'briefcase'],
                ['label' => 'Job Seekers', 'count' => $stats['jobSeekers'], 'class' => 'warning', 'icon' => 'users'],
                ['label' => 'Active Jobs', 'count' => $stats['activeJobs'], 'class' => 'info', 'icon' => 'check-circle'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{{ $card['class'] }} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-{{ $card['class'] }} text-uppercase mb-1">
                                    {{ $card['label'] }}
                                </div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $card['count'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-{{ $card['icon'] }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h6 class="m-0 fw-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ route('admin.jobs.pending') }}" class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-tasks me-2"></i> Review Jobs
                        </a>
                    </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-users-cog me-2"></i> Manage Users
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.activity.logs') }}" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-chart-line me-2"></i> Activity Logs
                            </a>
                        </div>
                        <!-- <div class="col-md-6">
                            <a href="#" class="btn btn-outline-warning w-100 py-3">
                                <i class="fas fa-cog me-2"></i> Settings
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <h6 class="m-0 fw-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="activity-feed">
                        @php
                            $activities = [
                                ['icon' => 'user-plus', 'class' => 'primary', 'text' => 'New employer registered', 'time' => '5 minutes ago'],
                                ['icon' => 'check-circle', 'class' => 'success', 'text' => 'Job listing approved', 'time' => '1 hour ago'],
                                ['icon' => 'exclamation-triangle', 'class' => 'danger', 'text' => 'Job listing rejected', 'time' => '3 hours ago'],
                                ['icon' => 'comment', 'class' => 'info', 'text' => 'New support ticket', 'time' => 'Yesterday'],
                            ];
                        @endphp

                        @foreach ($activities as $activity)
                            <div class="feed-item d-flex align-items-center mb-3">
                                <div class="feed-icon bg-{{ $activity['class'] }} text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="fas fa-{{ $activity['icon'] }}"></i>
                                </div>
                                <div>
                                    <span class="fw-bold">{{ $activity['text'] }}</span><br>
                                    <small class="text-muted">{{ $activity['time'] }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function updateCurrentDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
    }
    updateCurrentDate();
    setInterval(updateCurrentDate, 60000);
</script>
@endsection
