@extends('layouts.app')

@section('content')
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    
    @if(auth()->user()->role === 'admin')
        <p>This is the Admin dashboard.</p>
    @elseif(auth()->user()->role === 'employer')
        <p>This is the Employer dashboard.</p>
    @elseif(auth()->user()->role === 'jobseeker')
        <p>This is the Job Seeker dashboard.</p>
    @else
        <p>Role not recognized.</p>
    @endif
@endsection