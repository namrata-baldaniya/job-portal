@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Job Post Details</span>
                    <div>
                        <a href="{{ route('employer.job_posts.edit', $jobPost) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('employer.job_posts.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-list"></i> All Jobs
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <h4 class="mb-3">{{ $jobPost->title }}</h4>
                    
                    <div class="mb-4">
                        <span class="badge bg-{{ 
                            $jobPost->status === 'approved' ? 'success' : 
                            ($jobPost->status === 'rejected' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($jobPost->status) }}
                        </span>
                        <span class="text-muted ms-2">
                            Posted: {{ $jobPost->created_at->format('M d, Y') }}
                        </span>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Location</h6>
                                    <p class="card-text">{{ $jobPost->location }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Salary</h6>
                                    <p class="card-text">{{ $jobPost->salary ? '$'.number_format($jobPost->salary) : 'Not specified' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Deadline</h6>
                                    <p class="card-text">{{ $jobPost->deadline->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Applications</h6>
                                    <p class="card-text">{{ $jobPost->applications_count }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Job Description</h5>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($jobPost->description)) !!}
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5>Requirements</h5>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($jobPost->requirements)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection