@extends('pages.auth-page')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center m-0">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-sm p-4">
            <h3 class="text-center mb-4">Register an Account</h3>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                        placeholder="Enter your full name" required value="{{ old('name') }}">
                </div>

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
                        placeholder="Enter password" required>
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" 
                        name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <button type="submit" class="btn btn-danger w-100">Register</button>

                <p class="text-center mt-3">
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection
