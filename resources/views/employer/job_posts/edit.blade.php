@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Edit Job Post</span>
                    <a href="{{ route('employer.job_posts.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employer.job_posts.update', $jobPost) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Job Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $jobPost->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Job Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $jobPost->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="requirements" class="form-label">Requirements *</label>
                            <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                      id="requirements" name="requirements" rows="5" required>{{ old('requirements', $jobPost->requirements) }}</textarea>
                            @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location *</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location', $jobPost->location) }}" required>
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="salary" class="form-label">Salary (optional)</label>
                                <input type="number" class="form-control @error('salary') is-invalid @enderror" 
                                       id="salary" name="salary" value="{{ old('salary', $jobPost->salary) }}">
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Application Deadline *</label>
                            <input type="date" class="form-control @error('deadline') is-invalid @enderror" 
                                   id="deadline" name="deadline" 
                                   value="{{ old('deadline', $jobPost->deadline->format('Y-m-d')) }}" 
                                   min="{{ now()->format('Y-m-d') }}" required>
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($jobPost->status !== 'approved')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status">
                                <option value="pending" {{ old('status', $jobPost->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ old('status', $jobPost->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Job Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Simple date validation
    document.getElementById('deadline').addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        const today = new Date();
        
        if (selectedDate < today) {
            alert('Deadline must be in the future');
            this.value = '';
        }
    });
</script>
@endsection