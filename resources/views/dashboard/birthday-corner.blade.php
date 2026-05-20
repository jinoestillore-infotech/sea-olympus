<style>
    .birthday-card {
        height: 170px;
    }

    .birthday-bg {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.4s ease;
    }

    .birthday-bg img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .birthday-card:hover .birthday-bg {
        transform: scale(1.08);
    }

    .birthday-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top,
                rgba(0, 0, 0, 0.5),
                rgba(0, 0, 0, 0.15));
    }
</style>

<div class="container-fluid py-3 mt-5">
    {{-- Month Title --}}
    @if($birthdays->count())
        <div class="mb-3 mt-5">
            <h4 class="fw-bold text-danger">
                {{ \Carbon\Carbon::now()->format('F') }} Celebrants
            </h4>
        </div>
    @endif
    <div class="row g-3 justify-content-center justify-content-md-start">
        @forelse($birthdays as $birthday)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="birthday-card position-relative rounded-4 overflow-hidden shadow-sm">
                    <div class="birthday-bg">
                            <img src="{{ $birthday->profile_picture 
                                ? asset($birthday->profile_picture)
                                : asset('images/birthday_profiles/default-profile.png') }}"
                            loading="lazy"
                            class="w-100 h-100 object-fit-cover">
                    </div>
                    <div class="birthday-overlay"></div>
                </div>
                <div class="text-center mt-2">
                    <p class="m-0">{{ $birthday->employee->first_name }} {{ $birthday->employee->last_name }}</p>
                    <span class="fw-bold fs-5 text-danger m-0">
                        {{ \Carbon\Carbon::parse($birthday->birthdate)->format('d') }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                No Birthday Celebrants This Month
            </div>
        @endforelse
    </div>
</div>