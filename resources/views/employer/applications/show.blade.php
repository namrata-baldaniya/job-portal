@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Application Details</h5>
                    <a href="{{ route('employer.applications.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Job Information</h6>
                            <p><strong>Title:</strong> {{ $application->jobPost->title }}</p>
                            <p><strong>Posted:</strong> {{ $application->jobPost->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Applicant Information</h6>
                            <p><strong>Name:</strong> {{ $application->user->name }}</p>
                            <p><strong>Email:</strong> {{ $application->user->email }}</p>
                            @if($application->user->resume)
                                <a href="{{ Storage::url($application->user->resume->file_path) }}" 
                                   class="btn btn-sm btn-outline-primary mt-2" target="_blank">
                                    <i class="fas fa-download"></i> Download Resume
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6>Application Status</h6>
                        <span class="badge bg-{{ 
                            $application->status === 'accepted' ? 'success' : 
                            ($application->status === 'rejected' ? 'danger' : 'warning') 
                        }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <h6>Cover Letter</h6>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>

                    @if($application->feedback)
                    <div class="mb-4">
                        <h6>Your Feedback</h6>
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

                    <div class="d-flex justify-content-end gap-2">
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                            <i class="fas fa-edit"></i> Update Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('employer.applications.update', $application) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Application Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $application->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Feedback (Optional)</label>
                        <textarea class="form-control" id="feedback" name="feedback" rows="3">{{ old('feedback', $application->feedback) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="interview_date" class="form-label">Interview Date (If Accepted)</label>
                        <input type="datetime-local" class="form-control" id="interview_date" 
                               name="interview_date" value="{{ old('interview_date', $application->interview_date ? $application->interview_date->format('Y-m-d\TH:i') : '') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection