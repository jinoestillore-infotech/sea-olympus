@extends('dashboard.dashboard-layout')

@section('title', 'Company Calendar')

@section('content')
<div class="container-fluid m-0 pb-4 px-5 pt-4 mx-auto" style="background-color: #FFFF">
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
    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Company Calendar</h3>
        <div class="">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">&larr;Back to Dashboard</a>
        </div>
    </div>
    {{-- Add Holiday Form (Admin/Moderator Only) --}}
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="text-warning fw-bold">Add Holiday</h5>
            <form action="{{ route('calendar.store') }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="type" value="holiday">
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control"
                        min="{{ now()->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control"
                        placeholder="Holiday Name" required>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-warning w-100">
                        Add Holiday
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="text-danger fw-bold">Add Non-Operating Day</h5>
            <form action="{{ route('calendar.store') }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="type" value="non_operating">
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control"
                        min="{{ now()->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control"
                        placeholder="Reason (Maintenance, etc...)" required>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-danger w-100">
                        Add Non-Operating Day
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
    @include ('dashboard.calendar.calendar-card')
</div>

<style>
.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
}

.calendar-header {
    font-weight: bold;
    text-align: center;
    padding: 10px 0;
    background: #f8f9fa;
}

.calendar-cell {
    min-height: 90px;
    border: 1px solid #eee;
    padding: 5px;
    position: relative;
    background: white;
}

.calendar-cell.non-operating {
    background-color: #ffe5e5;
    border: 1px solid #ffb3b3;
}

.calendar-cell.holiday {
    background-color: #fff4e5;
    border: 1px solid #ffc266;
}

.day-number {
    font-weight: bold;
}

.empty {
    background: #fafafa;
}

@media (max-width: 768px) {
    .calendar-cell {
        min-height: 70px;
        font-size: 12px;
    }
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            document.querySelectorAll('.auto-dismiss').forEach(function (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');

                setTimeout(() => alert.remove(), 1000); 
            });
        }, 2000); 
    });
</script>
@endsection
