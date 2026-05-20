@extends('dashboard.dashboard-layout')

@section('title', 'All Announcements')

@section('content')
<style>
    .card-body .row:hover {
        background-color: #f8f9fa;
    }

    .card-body .row:first-child {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 1;
    }

    .card-body {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
<div class="container-fluid pb-4 px-5 pt-4" style="background-color: #FFFF">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">All Announcements</h3>
        <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">&larr;Back to Dashboard</a>
    </div>
        <a href="{{ route('announcement.create') }}" class="btn btn-danger mb-2">
            <i class="bi bi-plus-circle"></i> Announce
        </a>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if($announcements->count())
    <div class="card shadow-sm">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-muted bg-light">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            @if(auth()->user()->isStaff())
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($announcements as $announcement)
                        <tr>
                            <td class="fw-medium">{{ $announcement->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($announcement->description, 80) }}</td>
                            <td>
                                @if($announcement->image)
                                    <img src="{{ asset( $announcement->image) }}"
                                         alt="Announcement Image"
                                         class="rounded"
                                         style="width: 60px; height: 60px; object-fit: cover;"
                                         loading="lazy">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            @if(auth()->user()->isStaff())
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('announcement.edit', $announcement->id) }}"
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                       <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('announcement.destroy', $announcement->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Pagination --}}
        <div class="card-footer d-flex justify-content-end border-0" style="background-color: white;">
            {{ $announcements->links() }}
        </div>
    </div>
    @else
        <div class="alert alert-info text-center">
            No announcements found.
        </div>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            document.querySelectorAll('.auto-dismiss').forEach(alert => {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500);
            });
        }, 2000);
    });
</script>
@endsection
