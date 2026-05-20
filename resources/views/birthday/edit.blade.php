@extends('dashboard.dashboard-layout')

@section('title', 'Edit Birthday Celebrant')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            Edit Birthday Celebrant
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
            <form action="{{ route('birthday.update', $birthday->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  id="editBirthdayForm">
                @csrf
                @method('PUT')
                <div class="row">

                    {{-- Employee (Read Only) --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Employee</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $birthday->employee->first_name }} {{ $birthday->employee->last_name }} ({{ $birthday->employee->department->name }})"
                               disabled>
                    </div>
                    {{-- Birthdate --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Birthdate</label>
                        <input type="date"
                               name="birthdate"
                               class="form-control"
                               value="{{ old('birthdate', $birthday->birthdate) }}"
                               required>
                    </div>
                    {{-- Current Profile Picture --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current Profile Picture</label>
                        <div class="mb-2">
                            <img src="{{ $birthday->profile_picture 
                                    ? asset($birthday->profile_picture) 
                                    : asset('images/birthday_profiles/default-profile.png') }}"
                                 class="rounded-circle shadow"
                                 style="width:120px; height:120px; object-fit:cover;"
                                 loading="lazy">
                        </div>
                    </div>
                    {{-- Change Profile Picture --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Change Profile Picture</label>
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
                            id="updateBirthdayBtn">
                        <i class="bi bi-save"></i> Update Birthday
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editBirthdayForm');
    const submitBtn = document.getElementById('updateBirthdayBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 
            `<span class="spinner-border spinner-border-sm me-2"></span>Updating...`;
    });
});
</script>

@endsection