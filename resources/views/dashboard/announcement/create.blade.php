@extends('dashboard.dashboard-layout')

@section('title', 'Create Announcement')

@section('content')
<div class="container py-5 pt-0">
    <div class="d-flex justify-content-between mt-4">
        <h2 class="mb-4 fw-bold">Create Announcement</h2>
        <div class="">
            <a href="{{ route('announcement.index') }}" class="text-decoration-none text-secondary">&larr;Back to Announcements</a>
        </div>
     </div>
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Announcement Form -->
    @include('dashboard.partials.create-announcement-form')
</div>
@endsection
