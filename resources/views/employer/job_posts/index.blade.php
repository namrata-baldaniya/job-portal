@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Job Posts</h5>
                    <a href="{{ route('employer.job_posts.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> New Job Post
                    </a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Applications</th>
                                    <th>Deadline</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobPosts as $jobPost)
                                <tr>
                                    <td>{{ $jobPost->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $jobPost->status === 'approved' ? 'success' : 
                                            ($jobPost->status === 'rejected' ? 'danger' : 'warning') 
                                        }}">
                                            {{ ucfirst($jobPost->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $jobPost->applications_count }}</td>
                                    <td>{{ $jobPost->deadline->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('employer.job_posts.show', $jobPost) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('employer.job_posts.edit', $jobPost) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('employer.job_posts.destroy', $jobPost) }}" 
                                              method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No job posts yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection