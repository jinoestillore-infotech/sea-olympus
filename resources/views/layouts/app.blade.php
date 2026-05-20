<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | S.E.A. Olympus</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('logo/logoOne.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/icons/bootstrap-icon/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
</head>
<body>
    <div class="container-fluid p-0 m-0">
        <div class="d-flex justify-content-between my-2 mx-2">
            <a class="" href="#">
                <img src="{{ asset('logo/sealogo1.png') }}"
                class="img-fluid"
                style="max-height:75px; max-width: 280px;"
                alt="SEA Olympus Marketing Inc. Logo"
                loading="lazy"
                >
            </a>
            <a href="{{ route('login') }}" class="text-decoration-none text-dark fs-1"><i class="bi bi-box-arrow-in-right me-1 login-icon" title="Login"></i></a>
        </div>

        <div class="border border-5 border-danger border-bottom-0 border-start-0 border-end-0 nav-blur rounded-5 mt-3 mx-5 sticky-top">
            @include ('layouts.nav')
        </div>
    
        <div class="container rounded-1 content mt-5 mx-auto">
            @yield('content')
        </div>

        @include ('layouts.footer')
    
        <footer class="my-4">
            <p class="text-center">&copy; Copyright 2026 - S.E.A. Olympus Marketing Inc.</p>
        </footer>
    </div>






    <!-- <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> -->
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>

<script>
  AOS.init({
    duration: 1000, // fade duration in milliseconds
    once: false,      // animate only once
    mirror: true
  });
</script>
</body>
</html>