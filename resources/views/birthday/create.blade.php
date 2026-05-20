@extends('dashboard.dashboard-layout')

@section('title', 'Add Birthday Celebrant')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            Add Birthday Celebrant
        </h2>
        <a href="{{ route('birthday.index') }}" 
           class="text-decoration-none text-secondary">
            &larr; Back to Birthday Corner
        </a>
    </div>
    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('birthday.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  id="createBirthdayForm">
                @csrf
                <div class="row">
                    {{-- Select Employee --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Select Employee</label>
                        <select name="employee_id"
                                class="form-control"
                                required>
                            <option value="">-- Select Employee --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} 
                                    {{ $employee->last_name }}
                                    ({{ $employee->department->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Birthdate --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Birthdate</label>
                        <input type="date"
                               name="birthdate"
                               class="form-control"
                               value="{{ old('birthdate') }}"
                               required>
                    </div>
                    {{-- Profile Picture --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file"
                               name="profile_picture"
                               class="form-control">
                        <small class="text-muted">
                            JPG, JPEG, PNG (Max 2MB)
                        </small>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" 
                            class="btn btn-danger"
                            id="submitBirthdayBtn">
                        <i class="bi bi-gift"></i> Add to Birthday Corner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createBirthdayForm');
    const submitBtn = document.getElementById('submitBirthdayBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 
            `<span class="spinner-border spinner-border-sm me-2"></span>Adding...`;
    });
});
</script>

@endsection