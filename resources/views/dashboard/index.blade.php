@extends('dashboard.dashboard-layout')

@section('title', 'Dashboard')

@section('content')
    <style>
        .scrollable-list {
            max-height: 250px;
            overflow-y: auto;
            padding-right: 5px;
        }
    </style>
    <div class="container-fluid p-4 pb-3" style="background-color: #FFFF">
        <div class="d-flex flex-column flex-md-column justify-content-between mb-3">
            <h4 class="p-0 m-0 mb-3">Welcome, {{ auth()->user()->role }}!</h4>
            <div class="d-flex justify-content-between mb-3 mb-md-0">
                <h2 class="fw-bold">Dashboard</h2>
                <div class="d-flex flex-wrap gap-3 d-flex justify-content-center">
                    @auth
        				@if(auth()->user()->role === 'admin')
                        <a href="{{ route('ip.index') }}"
                        class="text-danger fw-semibold text-decoration-none semi-nav {{ request()->routeIs('ip.*') ? 'active-nav' : '' }}">
                            <i class="bi bi-router fs-5"></i> IP Management
                        </a>
        @endif
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
                            <a href="{{ route('birthday.index') }}"
                                class="text-danger fw-semibold text-decoration-none semi-nav {{ request()->routeIs('birthday.*') ? 'active-nav' : '' }}">
                                <i class="bi bi-gift fs-5"></i> Birthday Celebrants
                            </a>
                        @endif
                        <a href="{{ route('calendar.index') }}"
                            class="text-danger fw-semibold text-decoration-none semi-nav {{ request()->routeIs('calendar.*') ? 'active-nav' : '' }}">
                            <i class="bi bi-calendar-event fs-5"></i> Calendar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @include ('dashboard.dashboard-card')
        @include ('dashboard.birthday-corner')
        @include ('dashboard.all-announcement')
        <div class="row g-4">
            @forelse($announcements as $announcement)
                <div class="col-12 col-sm-6 col-lg-4">
                    <a href="{{ route('announcement.show', $announcement) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm hover-shadow border">
                            @if($announcement->image)
                                <img src="{{ asset($announcement->image) }}"
                                    class="card-img-top img-fluid announcement-img mt-4" alt="{{ $announcement->title }}" loading="lazy">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold text-danger">
                                    {{ $announcement->title }}
                                </h5>
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit($announcement->description, 100) }}
                                </p>
                                <small class="text-muted mt-auto">
                                    {{ $announcement->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No announcements yet.</p>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $announcements->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
    <style>
        .hover-shadow {
            transition: all 0.3s ease !important;
        }

        .hover-shadow:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
            transform: translateY(-3px) !important;
        }

        .announcement-img {
            height: 200px;
            object-fit: contain;
        }

        @media (max-width: 576px) {
            .announcement-img {
                height: 180px;
            }
        }
    </style>
@endsection