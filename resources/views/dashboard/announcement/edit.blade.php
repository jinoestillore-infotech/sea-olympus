@extends('dashboard.dashboard-layout')

@section('title', 'Edit: ' . $announcement->title)

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit Announcement</h2>
        <a href="{{ auth()->check() ? url()->previous() : route('dashboard') }}" class="text-decoration-none text-secondary">
            Cancel <i class="bi bi-x-lg"></i>
        </a>
    </div>
    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow border-0">
        <div class="card-body p-4">
            <form action="{{ route('announcement.update', $announcement) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Title</label>
                        <input type="text" name="title" class="form-control" 
                            value="{{ old('title', $announcement->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" rows="5" class="form-control" required>{{ old('description', $announcement->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                        @if($announcement->image)
                            <img src="{{ asset($announcement->image) }}" 
                                class="img-fluid mt-2" style="max-height: 150px;" 
                                alt="Current Image"
                                loading="lazy">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-pencil-square"></i> Update Announcement
                    </button>
                </form>
        </div>
    </div>
</div>
@endsection
