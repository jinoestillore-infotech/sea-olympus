@extends('dashboard.dashboard-layout')

@section('title', 'Manage Departments')

@section('content')
<div class="container-fluid pb-5 pt-4 p-5" style="background-color: #FFFF">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Departments</h2>
        <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
            &larr;Back to Dashboard
        </a>
    </div>
    <div class="mb-2">
        <a href="{{ route('departments.create') }}" class="btn btn-danger">
            <i class="bi bi-building-add"></i> Add Department
        </a>
    </div>
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
            {{ session('success') }}
        </div>
    @endif
    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Department Name</th>
                            <th>Description</th>
                            <th>Employees</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $department->name }}
                                </td>
                                <td>
                                    {{ $department->description ?? '—' }}
                                </td>
                                <td>
                                    {{ $department->employees->count() ?? 0 }}
                                </td>
                                <td class="text-end">
                                    {{-- Show --}}
                                    <a href="{{ route('departments.show', $department->id) }}"
                                    class="btn btn-sm btn-outline-success" title="Show">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    {{-- Edit --}}
                                    <a href="{{ route('departments.edit', $department->id) }}"
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    {{-- Delete --}}
                                    <form action="{{ route('departments.delete', $department->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this department?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No department found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination (if you paginate later) --}}
            @if(method_exists($departments, 'links'))
                <div class="mt-3">
                    {{ $departments->links('pagination::simple-bootstrap-5') }}
                </div>
            @endif
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
</script>

@endsection
