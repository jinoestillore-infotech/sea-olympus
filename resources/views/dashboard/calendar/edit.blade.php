@extends('dashboard.dashboard-layout')

@section('title', 'Edit Entry')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            Edit {{ ucfirst(str_replace('_',' ', $holiday->type)) }}
        </h3>
        <a href="{{ route('calendar.index') }}" class="text-decoration-none text-secondary">
            &larr; Back to Calendar
        </a>
    </div>
    <div class="card shadow border-0">
        <div class="card-body p-4">
            <form action="{{ route('calendar.update', $holiday->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')
                {{-- Date --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Date</label>
                    <input type="date"
                           name="date"
                           value="{{ $holiday->date->format('Y-m-d') }}"
                           class="form-control form-control-lg"
                           required>
                </div>
                {{-- Title --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text"
                           name="title"
                           value="{{ $holiday->title }}"
                           class="form-control form-control-lg"
                           placeholder="Enter title"
                           required>
                </div>
                {{-- Buttons --}}
                <div class="col-12 d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="bi bi-check-lg me-1"></i> Save Changes
                    </button>
                    <a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
