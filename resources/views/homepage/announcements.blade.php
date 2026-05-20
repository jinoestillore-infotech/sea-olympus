<style>
    .scrollable-list {
        max-height: 250px;   
        overflow-y: auto;   
        padding-right: 5px; 
    }

    .calendar-hover:hover {
        background-color: rgba(242, 243, 245, 0.87);
        border-radius: 20px !important;
    }
</style>
     <div class="m-0">
        <h1 class="mb-1 fw-bold">Announcements</h1>
        <div class="row g-4">
            @forelse($announcements as $announcement)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('announcement.show', $announcement) }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm hover-shadow border">
                        <div class="card-header border-0 bg-white">    
                        @if($announcement->image)
                            <img src="{{ asset($announcement->image) }}" class="card-img-top mt-2" alt="{{ $announcement->title }}" loading="lazy">
                        @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold text-danger">{{ $announcement->title }}</h5>
                            <p class="card-text text-truncate">{{ $announcement->description }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <small class="text-muted mt-auto">{{ $announcement->created_at->format('M d, Y') }}</small>
                        </div>
                    </div>
                </a>
            </div>
            @empty
                <p class="text-muted">No announcements yet.</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center m-0 mt-3">
            {{ $announcements->links('pagination::simple-bootstrap-5') }}
        </div>
        @if(isset($upcomingHolidays) && $upcomingHolidays->count())
        <div class="card shadow-sm border-0 mb-4 mt-4">
            <div class="card-body">
                <h5 class="fw-bold text-danger mb-3">
                    <i class="bi bi-calendar-x"></i> Company Calendar
                </h5>
                <ul class="list-group list-group-flush scrollable-list">
                    @foreach($upcomingHolidays as $holiday)
                        @php
                            $date = \Carbon\Carbon::parse($holiday->date);
                        @endphp
                        <li class="list-group-item p-0 rounded-4">
                            <a href="{{ route('pages.calendar-view', ['month' => $date->month, 'year' => $date->year, 'highlight' => $date->format('Y-m-d') ]) }}"
                            class="d-flex justify-content-between align-items-center
                                    text-decoration-none text-dark px-3 py-2 calendar-hover">
                                <div>
                                    <strong>{{ $date->format('F d, Y') }}</strong>
                                    <div class="small text-muted">
                                        <p class="calendar-title mb-0">{{ $holiday->title }}</p>
                                    </div>
                                </div>
                                <span class="badge 
                                    {{ $holiday->type === 'holiday' ? 'bg-warning text-dark' : 'bg-danger' }}">
                                    {{ $holiday->type === 'holiday' ? 'Holiday' : 'Non-Operating' }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
        @include('homepage.birthday-corner') 