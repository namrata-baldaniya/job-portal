@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Resume</h5>
                    @if($resume)
                        <div>
                            <a href="{{ route('jobseeker.resume.edit', $resume->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($resume)
                        <div class="mb-4">
                            <h6>Resume File</h6>
                            <a href="{{ Storage::url($resume->file_path) }}" 
                               target="_blank" class="btn btn-outline-primary">
                                <i class="fas fa-download"></i> Download Resume
                            </a>
                        </div>

                        @if($resume->skills)
                        <div class="mb-4">
                            <h6>Skills</h6>
                            <div class="border p-3 bg-light rounded">
                                {!! nl2br(e($resume->skills)) !!}
                            </div>
                        </div>
                        @endif

                        @if($resume->experience)
                        <div class="mb-4">
                            <h6>Experience</h6>
                            <div class="border p-3 bg-light rounded">
                                {!! nl2br(e($resume->experience)) !!}
                            </div>
                        </div>
                        @endif

                        @if($resume->education)
                        <div class="mb-4">
                            <h6>Education</h6>
                            <div class="border p-3 bg-light rounded">
                                {!! nl2br(e($resume->education)) !!}
                            </div>
                        </div>
                        @endif

                       
                    @else
                        <div class="alert alert-warning">
                            You haven't uploaded a resume yet.
                        </div>
                        <a href="{{ route('jobseeker.resume.create') }}" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Resume
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection