@extends('dashboard.dashboard-layout')

@section('title', 'Create User')

@section('content')
    <div class="container py-5 pt-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Create New User</h2>
            <a href="{{ route('admin.users') }}" class="text-decoration-none text-secondary">
                &larr; Back to Users
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
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}" id="createUserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user">User</option>
                                <option value="moderator">Moderator</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-danger" id="submitUserBtn">
                            <i class="bi bi-person-plus"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('createUserForm');
            const submitBtn = document.getElementById('submitUserBtn');

            form.addEventListener('submit', function () {
                // Disable the submit button immediately
                submitBtn.disabled = true;

                // Optional: show spinner while submitting
                submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Creating user...`;
            });
        });
    </script>
@endsection