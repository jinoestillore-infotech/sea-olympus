@extends('dashboard.dashboard-layout')

@section('title', 'Birthday Celebrants')

@section('content')
<div class="container-fluid py-4 px-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0">
            Birthday Corner
        </h2>
        <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">&larr;Back to Dashboard</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @auth
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
        <div class="mb-3">
            <a href="{{ route('birthday.create') }}" class="btn btn-danger">
                <i class="bi bi-plus-circle"></i> Add Celebrant
            </a>
        </div>
    @endif
    @endauth
    @forelse($birthdays as $month => $celebrants)
        <div class="mb-5">
            <h4 class="border-bottom pb-2 mb-4 mt-5 fw-semibold">
                {{ $month }}
            </h4>
            <div class="row" style="max-height: 590px; overflow: auto;">
                @foreach($celebrants as $birthday)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-sm h-100 border-0">
                        {{-- Admin / Moderator Controls --}}
                        @auth
                            @if(in_array(auth()->user()->role, ['admin', 'moderator']))
                                <div class="position-absolute top-0 end-0 p-2">

                                    <div class="dropdown">
                                        <button class="btn btn-sm text-dark" 
                                                type="button" 
                                                data-bs-toggle="dropdown"
                                                style="border-radius: 12px;">
                                            &#8942;
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow">
                                            {{-- Edit --}}
                                            <li>
                                                <a class="dropdown-item"
                                                href="{{ route('birthday.edit', $birthday->id) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            {{-- Delete --}}
                                            <li>
                                                <form action="{{ route('birthday.delete', $birthday->id) }}" 
                                                    method="POST"
                                                    onsubmit="return confirm('Delete this birthday entry?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="dropdown-item text-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endauth
                            <div class="text-center mt-3">
                                @if($birthday->profile_picture)
                                    <img src="{{ asset($birthday->profile_picture) }}"
                                         class="rounded-circle"
                                         style="width:120px; height:120px; object-fit:cover;"
                                         loading="lazy">
                                @else
                                    <img src="{{ asset('images/birthday_profiles/default-profile.png') }}"
                                         class="rounded-circle"
                                         style="width:120px; height:120px; object-fit:cover;"
                                         loading="lazy">
                                @endif
                            </div>
                            <div class="card-body text-center">
                                <h5 class="fw-bold">
                                    {{ $birthday->employee->first_name }} 
                                    {{ $birthday->employee->last_name }}
                                </h5>
                                <p class="text-muted mb-1">
                                    {{ $birthday->employee->department->name }}
                                </p>
                                <p class="text-danger fw-semibold">
                                    {{ \Carbon\Carbon::parse($birthday->birthdate)->format('F d') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center text-muted">
            No birthday celebrants found.
        </div>
    @endforelse
</div>
@endsection