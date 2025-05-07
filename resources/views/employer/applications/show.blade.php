@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application for: {{ $application->jobPost->title }}</h5>
                    <span class="badge bg-{{ 
                        $application->status === 'accepted' ? 'success' : 
                        ($application->status === 'rejected' ? 'danger' : 'warning') 
                    }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Applicant Information</h6>
                            <p><strong>Name:</strong> {{ $application->user->name }}</p>
                            <p><strong>Email:</strong> {{ $application->user->email }}</p>
                            @if($application->user->resume)
                                <a href="{{ Storage::url($application->user->resume->file_path) }}" 
                                   target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-download"></i> Download Resume
                                </a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6>Job Information</h6>
                            <p><strong>Title:</strong> {{ $application->jobPost->title }}</p>
                            <p><strong>Company:</strong> {{ $application->jobPost->user->companyProfile->company_name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6>Cover Letter</h6>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Update Application Status</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('employer.applications.update-status', $application) }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="feedback" class="form-label">Feedback</label>
                                    <textarea class="form-control" id="feedback" name="feedback" rows="3">{{ old('feedback', $application->feedback) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="interview_date" class="form-label">Interview Date</label>
                                    <input type="datetime-local" class="form-control" id="interview_date" 
                                           name="interview_date" 
                                           value="{{ old('interview_date', $application->interview_date ? $application->interview_date->format('Y-m-d\TH:i') : '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="interview_notes" class="form-label">Interview Notes</label>
                                    <textarea class="form-control" id="interview_notes" name="interview_notes" rows="3">{{ old('interview_notes', $application->interview_notes) }}</textarea>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('employer.applications.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Applications
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection