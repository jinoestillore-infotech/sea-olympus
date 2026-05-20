@extends('dashboard.dashboard-layout')

@section('title', 'Department Employees')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">{{ $department->name }}</h2>
            <small class="text-muted">
                {{ $department->description ?? 'No description provided.' }}
            </small>
        </div>
        <a href="{{ route('departments.index') }}"
           class="text-decoration-none text-secondary">
            &larr;Back to Departments
        </a>
    </div>
    {{-- Add Employee Button --}}
    <div class="mb-3">
        <a href="{{ route('employees.create', $department->id) }}"
           class="btn btn-danger">
            <i class="bi bi-person-plus"></i> Add Employee
        </a>
    </div>
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-dismiss">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4 ms-auto">
                <div class="input-group">
                    <input type="text"
                        id="employeeSearch"
                        class="form-control"
                        placeholder="Search employee, email, or position...">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
            </div>
        </div>
            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Hire Date</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTable">
                        @forelse($employees as $employee)
                            <tr>
                                <td>
                                    {{ $employee->first_name }}
                                    {{ $employee->last_name }}
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->position ?? '—' }}</td>
                                <td>
                                    {{ $employee->hire_date
                                        ? \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y')
                                        : '—' }}
                                </td>
                                <td>
                                    <span class="badge bg-{{ $employee->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($employee->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    {{-- Edit --}}
                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Delete --}}
                                    <form action="{{ route('employees.delete', $employee->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this employee?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    No employees in this department.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            document.querySelectorAll('.auto-dismiss').forEach(function (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            });
        }, 2000);
    });

    document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("employeeSearch");
    const rows = document.querySelectorAll("#employeeTable tr");

    searchInput.addEventListener("keyup", function () {

        let search = this.value.toLowerCase();

        rows.forEach(row => {

            let text = row.innerText.toLowerCase();

            if(text.includes(search)){
                row.style.display = "";
            }else{
                row.style.display = "none";
            }

        });

    });

});
</script>

@endsection
