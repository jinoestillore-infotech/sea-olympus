{{-- Calendar --}}
    <div class="card shadow-sm">
        <div class="d-flex align-items-center justify-content-between m-3">
            @php
                $prevMonth = $currentMonth->copy()->subMonth();
                $nextMonth = $currentMonth->copy()->addMonth();
            @endphp
            <a href="{{ route('calendar.index', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}"
            class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-chevron-left"></i> {{ $prevMonth->format('F') }}
            </a>
            <h4 class="fw-bold mb-0">
                {{ $currentMonth->format('F Y') }}
            </h4>
            <a href="{{ route('calendar.index', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}"
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
                        {{ $isToday ? 'border border-success' : '' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="day-number">{{ $date }}</span>
                            @if($isToday)
                                <span class="badge bg-success ms-1">Today</span>
                            @endif
                            @if($dayData && (auth()->user()->role === 'admin' || auth()->user()->role === 'moderator'))
                            <div class="dropdown">
                                <i class="bi bi-three-dots text-muted small"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item"
                                        href="{{ route('calendar.edit', $dayData->id) }}">
                                        Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('calendar.destroy', $dayData->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this entry?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                        @if($dayData)
                            <small class="d-block fw-bold
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