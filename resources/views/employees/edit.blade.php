@extends('dashboard.dashboard-layout')

@section('title', 'Edit Employee')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">
            Edit Employee - {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
        <a href="{{ route('departments.show', $employee->department_id) }}" 
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
            <form action="{{ route('employees.update', $employee->id) }}" 
                  method="POST" 
                  id="editEmployeeForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text"
                               name="first_name"
                               class="form-control"
                               value="{{ old('first_name', $employee->first_name) }}"
                               required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text"
                               name="last_name"
                               class="form-control"
                               value="{{ old('last_name', $employee->last_name) }}"
                               required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $employee->email) }}"
                               required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $employee->phone) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Position</label>
                        <input type="text"
                               name="position"
                               class="form-control"
                               value="{{ old('position', $employee->position) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Hire Date</label>
                        <input type="date"
                               name="hire_date"
                               class="form-control"
                               value="{{ old('hire_date', $employee->hire_date) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Salary</label>
                        <input type="number"
                               step="0.01"
                               name="salary"
                               class="form-control"
                               value="{{ old('salary', $employee->salary) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ $employee->status == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" 
                            class="btn btn-primary" 
                            id="updateEmployeeBtn">
                        <i class="bi bi-save"></i> Update Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editEmployeeForm');
    const submitBtn = document.getElementById('updateEmployeeBtn');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 
            `<span class="spinner-border spinner-border-sm me-2"></span>Updating...`;
    });
});
</script>

@endsection
