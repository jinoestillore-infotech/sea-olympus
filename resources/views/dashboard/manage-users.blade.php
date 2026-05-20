@extends('dashboard.dashboard-layout')

@section('title', 'Manage Users')

@section('content')
    <div class="container-fluid py-5 px-5 pt-3" style="background-color: #FFFF">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Manage Users</h2>
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">&larr;Back to Dashboard</a>
        </div>
        <div class="mb-2">
            <a href="{{ route('admin.users.create') }}" class="btn btn-danger">
                <i class="bi bi-person-plus"></i> Add User
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
                <div class="table-responsive" style="max-height: 370px; overflow-y: auto;">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @php
                                            $badgeColor = match ($user->role) {
                                                'admin' => 'success',
                                                'moderator' => 'primary',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeColor }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        @php
                                            $currentUser = auth()->user();
                                        @endphp
                                        @php
                                            $canDelete = false;
                                            // Cannot delete yourself
                                            if ($currentUser->id !== $user->id) {
                                                // Admin can delete anyone
                                                if ($currentUser->isAdmin()) {
                                                    $canDelete = true;
                                                }
                                                // Moderator can delete only normal users
                                                elseif ($currentUser->isModerator() && $user->role === 'user') {
                                                    $canDelete = true;
                                                }
                                            }
                                        @endphp
                                        @if($canDelete)
                                            <form action="{{ route('admin.users.delete', $user) }}" method="POST"
                                                @if($user->role === 'admin') onsubmit="return confirmAdminDelete(this)" @else
                                                onsubmit="return confirm('Delete this user?')" @endif>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $users->links('pagination::simple-bootstrap-5') }}
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
    </script>

    <script>
        function confirmAdminDelete(form) {
            let code = prompt("Enter admin deletion code:");

            if (!code) {
                // alert("Deletion cancelled.");
                return false;
            }

            // create hidden input dynamically
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "admin_delete_code";
            input.value = code;
            form.appendChild(input);

            return confirm("Code Verified Successfully! \nAre you sure you want to delete this admin?");
        }
    </script>
@endsection