@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Resume</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jobseeker.resume.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="resume_file" class="form-label">Resume File *</label>
                            <input type="file" class="form-control @error('resume_file') is-invalid @enderror" 
                                   id="resume_file" name="resume_file" required>
                            <small class="text-muted">Accepted formats: PDF, DOC, DOCX (Max 2MB)</small>
                            @error('resume_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills</label>
                            <textarea class="form-control @error('skills') is-invalid @enderror" 
                                      id="skills" name="skills" rows="3">{{ old('skills') }}</textarea>
                            <small class="text-muted">List your key skills (optional)</small>
                            @error('skills')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="experience" class="form-label">Work Experience</label>
                            <textarea class="form-control @error('experience') is-invalid @enderror" 
                                      id="experience" name="experience" rows="3">{{ old('experience') }}</textarea>
                            <small class="text-muted">Describe your work experience (optional)</small>
                            @error('experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="education" class="form-label">Education</label>
                            <textarea class="form-control @error('education') is-invalid @enderror" 
                                      id="education" name="education" rows="3">{{ old('education') }}</textarea>
                            <small class="text-muted">List your educational background (optional)</small>
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Upload Resume
                            </button>
                            <a href="{{ route('jobseeker.resume.index') }}" class="btn btn-secondary">
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