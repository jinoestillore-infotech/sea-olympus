<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | SEA Olympus</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('logo/logoOne.png') }}" type="image/x-icon" loading="lazy">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/icons/bootstrap-icon/bootstrap-icons.css') }}">
</head>
<body>
    <div class="container-fluid p-0 m-0">
        <div class="d-flex justify-content-center my-2">
            <a class="" href="{{ route('home') }}">
                <img src="{{ asset('logo/sealogo1.png') }}"
                class="img-fluid"
                style="max-height:80px; max-width: 250px;"
                alt="SEA Olympus Marketing Inc. Logo"
                loading="lazy"
                >
            </a>
        </div>
    
        <div class="container rounded-1 content mt-5 mx-auto">
            @yield('content')
        </div>

        @include ('layouts.footer')
    
        <footer class="my-4">
            <p class="text-center">&copy; Copyright of 2026 - S.E.A. Olympus Marketing Inc.</p>
        </footer>
    </div>






    <script src="{{ asset('js/bootstrap.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
</body>
</html>