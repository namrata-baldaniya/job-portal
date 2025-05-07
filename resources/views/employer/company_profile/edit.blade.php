@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Company Profile</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('employer.company_profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $profile->company_name) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $profile->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="url" name="website" class="form-control" value="{{ old('website', $profile->website) }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $profile->phone) }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ old('address', $profile->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label><br>
            @if ($profile->logo)
                <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo" width="100"><br>
            @endif
            <input type="file" name="logo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
