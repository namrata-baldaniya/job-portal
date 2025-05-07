@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>{{ $jobPost->title }}</h2>
            <p class="text-muted">Posted {{ $jobPost->created_at->diffForHumans() }}</p>

            <h5>Company: {{ $jobPost->user->companyProfile->company_name ?? 'N/A' }}</h5>
            <p><strong>Location:</strong> {{ $jobPost->location ?? 'Not specified' }}</p>
            <p><strong>Salary:</strong> {{ $jobPost->salary ?? 'Not specified' }}</p>

            <hr>

            <h4>Job Description</h4>
            <p>{{ $jobPost->description }}</p>

            <h4>Requirements</h4>
            <p>{{ $jobPost->requirements }}</p>
        </div>

        <div class="col-md-4">
            @auth
                @if(auth()->user()->jobSeeker && !$jobPost->applications->where('job_seeker_id', auth()->user()->jobSeeker->id)->count())
                    <form action="{{ route('jobseeker.applications.store', $jobPost->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">Apply Now</button>
                    </form>
                @else
                    <div class="alert alert-success">
                        You have already applied for this job.
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
