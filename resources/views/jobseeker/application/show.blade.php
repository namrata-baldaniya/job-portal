@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Details</h5>
                    <a href="{{ route('jobseeker.applications.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Job Information</h6>
                            <p><strong>Title:</strong> {{ $application->jobPost->title }}</p>
                            <p><strong>Company:</strong> {{ $application->jobPost->user->companyProfile->company_name ?? 'N/A' }}</p>
                            <p><strong>Posted:</strong> {{ $application->jobPost->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Application Status</h6>
                            <span class="badge bg-{{ 
                                $application->status === 'accepted' ? 'success' : 
                                ($application->status === 'rejected' ? 'danger' : 'warning') 
                            }}">
                                {{ ucfirst($application->status) }}
                            </span>
                            <p class="mt-2"><strong>Applied:</strong> {{ $application->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6>Your Cover Letter</h6>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>

                    @if($application->feedback)
                    <div class="mb-4">
                        <h6>Employer Feedback</h6>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($application->feedback)) !!}
                        </div>
                    </div>
                    @endif

                    @if($application->interview_date)
                    <div class="mb-4">
                        <h6>Interview Scheduled</h6>
                        <p>{{ $application->interview_date->format('l, F j, Y \a\t g:i A') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection