@extends('dashboard.dashboard-layout')

@section('title', 'Add Employee')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            Add Employee - {{ $department->name }}
        </h2>
        <a href="{{ route('departments.show', $department->id) }}" 
           class="text-decoration-none text-secondary">
            &larr;Back to Employees
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
            <form action="{{ route('employees.store') }}" 
                  method="POST" 
                  id="createEmployeeForm">
                @csrf
                <input type="hidden" name="department_id" value="{{ $department->id }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text"
                               name="first_name"
                               class="form-control"
                               value="{{ old('first_name') }}"
                               required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text"
                               name="last_name"
                               class="form-control"
                               value="{{ old('last_name') }}"
                               required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Position</label>
                        <input type="text"
                               name="position"
                               class="form-control"
                               value="{{ old('position') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hire Date</label>
                        <input type="date"
                               name="hire_date"
                               class="form-control"
                               value="{{ old('hire_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Salary</label>
                        <input type="number"
                               step="0.01"
                               name="salary"
                               class="form-control"
                               value="{{ old('salary') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" 
                            class="btn btn-danger" 
                            id="submitEmployeeBtn">
                        <i class="bi bi-check-circle"></i> Add Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createEmployeeForm');
    const submitBtn = document.getElementById('submitEmployeeBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 
            `<span class="spinner-border spinner-border-sm me-2"></span>Adding...`;
    });
});
</script>

@endsection
