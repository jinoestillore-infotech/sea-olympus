<style>
    .calendar-hover:hover {
        background-color: rgba(242, 243, 245, 0.87);
        border-radius: 20px;
    }
</style>

<h4 class="mb-4 text-secondary" style="margin-top: 70px;">All Announcements</h4>
@if(isset($upcomingHolidays) && $upcomingHolidays->count())
    <div class="card shadow-sm border-0 mb-4 mt-4">
        <div class="card-body">
            <h5 class="fw-bold text-danger mb-3">
                <i class="bi bi-calendar-x"></i> Company Calendar
            </h5>
            <ul class="list-group list-group-flush scrollable-list">
                @foreach($upcomingHolidays as $holiday)
                    <li class="list-group-item d-flex justify-content-between align-items-center calendar-hover">
                        <div>
                            <strong>{{ \Carbon\Carbon::parse($holiday->date)->format('F d, Y') }}</strong>
                            <div class="small text-muted">
                                {{ $holiday->title }}
                            </div>
                        </div>
                        <span class="badge 
                                        {{ $holiday->type === 'holiday' ? 'bg-warning text-dark' : 'bg-danger' }}">
                            {{ $holiday->type === 'holiday' ? 'Holiday' : 'Non-Operating' }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif