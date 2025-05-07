@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Details</h5>
                    <div>
                        <span class="badge bg-{{ 
                            $application->status === 'accepted' ? 'success' : 
                            ($application->status === 'rejected' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h6>Job Information</h6>
                        <div class="border p-3 bg-light rounded">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Position:</strong> {{ $application->jobPost->title }}</p>
                                    <p><strong>Company:</strong> {{ $application->jobPost->user->companyProfile->company_name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Applied:</strong> {{ $application->created_at->format('M d, Y') }}</p>
                                    <p><strong>Location:</strong> {{ $application->jobPost->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6>Your Application</h6>
                        <div class="border p-3 bg-light rounded">
                            <div class="mb-3">
                                <h6>Resume</h6>
                                <a href="{{ Storage::url(Auth::user()->resume->file_path) }}" 
                                   target="_blank" class="btn btn-outline-primary">
                                    <i class="fas fa-download"></i> Download Resume
                                </a>
                            </div>

                            <div>
                                <h6>Cover Letter</h6>
                                <div class="p-2">
                                    {!! nl2br(e($application->cover_letter)) !!}
                                </div>
                            </div>
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
                        <div class="border p-3 bg-light rounded">
                            <p>
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ $application->interview_date->format('l, F j, Y \a\t g:i A') }}
                            </p>
                            @if($application->interview_notes)
                            <div class="mt-2">
                                <h6>Interview Notes:</h6>
                                {!! nl2br(e($application->interview_notes)) !!}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="text-end">
                        <a href="{{ route('jobseeker.applications.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Applications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection