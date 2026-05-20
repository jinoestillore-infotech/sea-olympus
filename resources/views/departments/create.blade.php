@extends('dashboard.dashboard-layout')

@section('title', 'Add Department')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Add Department</h2>
        <a href="{{ route('departments.index') }}" class="text-decoration-none text-secondary">
            &larr;Back to Departments
        </a>
    </div>
    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST" id="createDepartmentForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Department Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger" id="submitDepartmentBtn">
                        <i class="bi bi-check-circle"></i> Save Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('createDepartmentForm');
        const submitBtn = document.getElementById('submitDepartmentBtn');

        form.addEventListener('submit', function () {
            // Disable the submit button immediately
            submitBtn.disabled = true;

            // Optional: show spinner while submitting
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...`;
        });
    });
</script>
@endsection
