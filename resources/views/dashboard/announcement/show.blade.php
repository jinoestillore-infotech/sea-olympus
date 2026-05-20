@extends('dashboard.dashboard-layout')

@section('title', $announcement->title)

@section('content')
<div class="container pt-2 pb-5">
    <div class="mt-md-0 d-flex justify-content-end">
        <a href="{{ auth()->check() ? route('dashboard') : (url()->previous() ?? route('landing')) }}"
        class="text-decoration-none text-secondary">
            &larr;Back to Dashboard
        </a>
    </div>
    <div class="d-flex  flex-md-row justify-content-end align-items-start align-items-md-center mb-4">
        <div>
            @auth
                @if(auth()->user()->isStaff())
                    <div class="dropdown">
                        <a class="text-decoration-none text-dark" href="#" role="button" id="announcementMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="announcementMenu">
                            <li>
                                <form action="{{ route('announcement.destroy', $announcement) }}" method="POST" onsubmit="return confirm('Delete this announcement?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item text-danger">
                                        Delete
                                    </button>
                                </form>
                            </li> 
                        </ul>
                    </div>
                @endif
            @endauth
        </div>
    </div>
    @if($announcement->image)
        <img src="{{ asset( $announcement->image) }}" 
             class="img-fluid mb-4 rounded shadow-sm img-show d-block mx-auto" 
             alt="{{ $announcement->title }}"
             loading="lazy"
             >
    @endif
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center mb-2 mb-md-0">
        <h2 class="fw-bold mb-2 mb-sm-0 me-0 me-sm-3">{{ $announcement->title }}</h2>
        @auth 
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
        <a class="text-dark small" href="{{ route('announcement.edit', $announcement) }}">
            Edit
        </a>
        @endif
        @endauth
    </div>
    <p class="mt-4">{{ $announcement->description }}</p>
    <small class="text-muted">Posted on {{ $announcement->created_at->format('M d, Y') }}</small>
</div>
@endsection
