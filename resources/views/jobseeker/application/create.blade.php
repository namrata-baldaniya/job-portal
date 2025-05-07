@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Apply for: {{ $jobPost->title }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jobseeker.applications.store', $jobPost) }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Your Resume</label>
                            <div>
                                <a href="{{ Storage::url(Auth::user()->resume->file_path) }}" 
                                   target="_blank" class="btn btn-outline-primary">
                                    <i class="fas fa-download"></i> View Your Resume
                                </a>
                            </div>
                            <small class="text-muted">This is the resume that will be sent with your application</small>
                        </div>

                        <div class="mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter *</label>
                            <textarea class="form-control @error('cover_letter') is-invalid @enderror" 
                                      id="cover_letter" name="cover_letter" rows="8" required>{{ old('cover_letter') }}</textarea>
                            @error('cover_letter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Explain why you're a good fit for this position</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Submit Application
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection