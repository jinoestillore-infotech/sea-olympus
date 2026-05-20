@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
    .highlight-day {
    background-color: rgba(220, 53, 69, 0.15) !important;
    animation: pulseHighlight 1.5s ease-in-out 2;
    }

    @keyframes pulseHighlight {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); border: 2px solid #2df6fd;}
        100% { transform: scale(1); border: 2px solid #2df6fd; }
    }
</style>
{{-- Calendar --}}
<a href="{{ route('home') }}"
        class="text-decoration-none text-secondary">
            &larr;Back to Home
</a>
    <div class="card shadow-sm mt-2">
        <div class="d-flex align-items-center justify-content-between m-3">
            @php
                $prevMonth = $currentMonth->copy()->subMonth();
                $nextMonth = $currentMonth->copy()->addMonth();
            @endphp

            <a href="{{ route('pages.calendar-view', ['month' => $prevMonth->month, 'year' => $prevMonth->year, 'highlight' => request('highlight') ]) }}"
            class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-chevron-left"></i> {{ $prevMonth->format('F') }}
            </a>

            <h4 class="fw-bold mb-0">
                {{ $currentMonth->format('F Y') }}
            </h4>

            <a href="{{ route('pages.calendar-view', ['month' => $nextMonth->month, 'year' => $nextMonth->year, 'highlight' => request('highlight') ]) }}"
            class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-chevron-right"></i> {{ $nextMonth->format('F') }}
            </a>
        </div>

        <div class="card-body">

            <div class="calendar-grid">

                @php
                    $startOfMonth = $currentMonth->copy()->startOfMonth();
                    $endOfMonth = $currentMonth->copy()->endOfMonth();
                    $startDay = $startOfMonth->dayOfWeek;
                @endphp

                {{-- Day Names --}}
                @foreach(['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
                    <div class="calendar-header">{{ $day }}</div>
                @endforeach

                {{-- Empty cells before first day --}}
                @for ($i = 0; $i < $startDay; $i++)
                    <div class="calendar-cell empty"></div>
                @endfor

                {{-- Days --}}
                @for ($date = 1; $date <= $endOfMonth->day; $date++)
                    @php
                        $fullDate = $currentMonth->format('Y-m-') . str_pad($date, 2, '0', STR_PAD_LEFT);
                        $dayData = $holidays[$fullDate] ?? null;
                        $type = $dayData->type ?? null;
                        $isToday = $fullDate === $today;
                    @endphp

                    <div class="calendar-cell
                        {{ $type === 'holiday' ? 'holiday' : '' }}
                        {{ $type === 'non_operating' ? 'non-operating' : '' }}
                        {{ $isToday ? 'border border-success' : '' }}
                        {{ isset($highlight) && $highlight === $fullDate ? 'highlight-day' : '' }}
                        ">

                        <div class="d-flex justify-content-between align-items-start">
                            <span class="day-number">{{ $date }}</span>
                            @if($isToday)
                                <span class="badge bg-success ms-1">Today</span>
                            @endif
                        </div>

                        @if($dayData)
                            <small class="d-block fw-bold text-center
                                {{ $type === 'holiday' ? 'text-warning' : '' }}
                                {{ $type === 'non_operating' ? 'text-danger' : '' }}">
                                {{ $dayData->title }}
                            </small>
                        @endif
                    </div>

                @endfor
            </div>

        </div>
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

@endsection