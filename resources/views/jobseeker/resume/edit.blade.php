@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Resume</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('jobseeker.resume.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Current Resume</label>
                            <div>
                                <a href="{{ Storage::url($resume->file_path) }}" 
                                   target="_blank" class="btn btn-outline-primary">
                                    <i class="fas fa-download"></i> Download Current Resume
                                </a>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="resume_file" class="form-label">Update Resume File</label>
                            <input type="file" class="form-control @error('resume_file') is-invalid @enderror" 
                                   id="resume_file" name="resume_file">
                            <small class="text-muted">Leave blank to keep current file</small>
                            @error('resume_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills</label>
                            <textarea class="form-control @error('skills') is-invalid @enderror" 
                                      id="skills" name="skills" rows="3">{{ old('skills', $resume->skills) }}</textarea>
                            @error('skills')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="experience" class="form-label">Work Experience</label>
                            <textarea class="form-control @error('experience') is-invalid @enderror" 
                                      id="experience" name="experience" rows="3">{{ old('experience', $resume->experience) }}</textarea>
                            @error('experience')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="education" class="form-label">Education</label>
                            <textarea class="form-control @error('education') is-invalid @enderror" 
                                      id="education" name="education" rows="3">{{ old('education', $resume->education) }}</textarea>
                            @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Resume
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