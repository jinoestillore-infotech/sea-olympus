@extends('pages.auth-page')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="card shadow-sm p-4">
            <h3 class="text-center mb-4">Login</h3>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" 
                        placeholder="Enter your email" required value="{{ old('email') }}">
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" 
                        placeholder="Enter your password" required>
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <button type="submit" class="btn btn-danger w-100">Login</button>

                <p class="text-center mt-3">
                    Don't have an account? <a href="#" id="register-link">Register here</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Auto dismiss alerts
    setTimeout(function () {
        document.querySelectorAll('.auto-dismiss').forEach(function (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); 
        });
    }, 2000);

    // Registration Code Prompt
    document.getElementById('register-link').addEventListener('click', function (e) {
        e.preventDefault();

        let code = prompt("Enter Registration Code:");

        if (code === null) return;

        fetch("{{ route('verify.registration.code') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ code: code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Code verified successfully!");
                window.location.href = "{{ route('register') }}";
            } else {
                alert("Invalid Registration Code!\n-- Contact your IT support. --");
            }
        });
    });

});
</script>


@endsection
