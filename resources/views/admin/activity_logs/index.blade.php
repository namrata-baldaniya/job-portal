@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Activity Logs</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at->format('d M Y h:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
