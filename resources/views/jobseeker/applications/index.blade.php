@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">My Job Applications</h1>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Applications</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                            id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter by Status
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="?status=all">All</a></li>
                        <li><a class="dropdown-item" href="?status=pending">Pending</a></li>
                        <li><a class="dropdown-item" href="?status=accepted">Accepted</a></li>
                        <li><a class="dropdown-item" href="?status=rejected">Rejected</a></li>
                    </ul>
                </div>
            </div>
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
                        @forelse($applications as $application)
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
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No applications found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection