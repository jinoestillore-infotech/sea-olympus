<div class="card shadow-sm mb-5 border-0">
    <div class="card-body">
        <h4 class="card-title mb-4">Create Announcement</h4>
        <form method="POST" action="{{ route('announcement.store') }}" enctype="multipart/form-data" class="row g-3" id="announcementForm">
            @csrf
            <div class="col-12">
                <label for="title" class="form-label fw-semibold">Title</label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          name="description" 
                          rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <label for="image" class="form-label fw-semibold">Image (optional)</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12">
                <button 
                    id="submitBtn"
                    type="submit" 
                    class="btn btn-danger fw-semibold"
                    @if(!in_array(auth()->user()->role, ['admin', 'moderator'])) disabled @endif
                >
                    Create Announcement
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('announcementForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function () {
            // Disable the submit button immediately
            submitBtn.disabled = true;

            // Optional: show a spinner or change text
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Creating...`;
        });
    });
</script>