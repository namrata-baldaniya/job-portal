@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $jobPost->title }}</h5>
                    <div>
                        <a href="{{ route('jobseeker.jobs.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Jobs
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">Job Details</h6>
                            @if(Auth::user()->resume)
                                <a href="{{ route('jobseeker.applications.create', $jobPost) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-paper-plane"></i> Apply Now
                                </a>
                            @else
                                <a href="{{ route('jobseeker.resume.create') }}" 
                                   class="btn btn-sm btn-danger">
                                    <i class="fas fa-exclamation-circle"></i> Upload Resume to Apply
                                </a>
                            @endif
                        </div>
                        <div class="border p-3 bg-light rounded">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Company:</strong> {{ $jobPost->user->companyProfile->company_name ?? 'Not specified' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Location:</strong> {{ $jobPost->location }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Salary:</strong> {{ $jobPost->salary ? '$'.number_format($jobPost->salary) : 'Not specified' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Deadline:</strong> {{ $jobPost->deadline->format('M d, Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6>Job Description</h6>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($jobPost->description)) !!}
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6>Requirements</h6>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($jobPost->requirements)) !!}
                        </div>
                    </div>

                    @if(Auth::user()->resume)
                    <div class="text-center mt-4">
                        <a href="{{ route('jobseeker.applications.create', $jobPost) }}" 
                           class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> Apply for this Position
                        </a>
                    </div>
                    @else
                    <div class="alert alert-warning text-center">
                        <p>You need to upload your resume before applying for jobs.</p>
                        <a href="{{ route('jobseeker.resume.create') }}" class="btn btn-danger">
                            <i class="fas fa-upload"></i> Upload Resume Now
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection