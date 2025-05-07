@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Browse Jobs</h2>

    @if($jobs->count() > 0)
        @foreach($jobs as $job)
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('jobseeker.jobs.show', $job->id) }}">
                            {{ $job->title }}
                        </a>
                    </h4>
                    <p class="card-text">
                        <strong>Company:</strong> {{ $job->user->companyProfile->company_name ?? 'N/A' }}<br>
                        <strong>Location:</strong> {{ $job->location ?? 'Not specified' }}<br>
                        <strong>Posted:</strong> {{ $job->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        @endforeach

        <div class="d-flex justify-content-center">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No job postings available at the moment.
        </div>
    @endif
</div>
@endsection
