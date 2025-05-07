@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Apply for: {{ $jobPost->title }}
                    <small class="text-muted float-end">
                        {{ $jobPost->user->companyProfile->company_name ?? 'N/A' }}
                    </small>
                </div>

                <div class="card-body">
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('jobseeker.applications.store', $jobPost) }}">
                        @csrf

                        <div class="mb-4">
                            <h6>Your Resume</h6>
                            <div class="border p-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file-alt me-2"></i>
                                        {{ basename(Auth::user()->resume->file_path) }}
                                    </div>
                                    <a href="{{ Storage::url(Auth::user()->resume->file_path) }}" 
                                       target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </div>
                            <small class="text-muted">This is the resume that will be sent with your application</small>
                        </div>

                        <div class="mb-4">
                            <label for="cover_letter" class="form-label">Cover Letter *</label>
                            <textarea class="form-control @error('cover_letter') is-invalid @enderror" 
                                      id="cover_letter" name="cover_letter" rows="8" required>{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Explain why you're a good fit for this position (minimum 100 characters)
                            </small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('jobseeker.jobs.show', $jobPost) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const coverLetter = document.getElementById('cover_letter');
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            if (coverLetter.value.length < 100) {
                e.preventDefault();
                alert('Your cover letter should be at least 100 characters long.');
            }
        });
    });
</script>
@endsection
@endsection