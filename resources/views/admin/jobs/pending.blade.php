@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="my-4">Pending Job Listings</h1>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($pendingJobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="card-text">{{ $job->description }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ $job->status }}</p>
                        <form method="POST" action="{{ route('admin.jobs.approve', $job) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.jobs.reject', $job) }}" class="mt-2">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
