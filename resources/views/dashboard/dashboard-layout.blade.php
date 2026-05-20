<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | S.E.A. Olympus</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preload" href="{{ asset('logo/logoOne.png') }}" as="image">
    <link rel="icon" href="{{ asset('logo/logoOne.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/icons/bootstrap-icon/bootstrap-icons.css') }}">

    <style>
        .navigation-item {
            text-decoration: none !important;
        }

        .navigation-item:hover {
            color: #03073d !important;
            border-bottom: 1px solid #03073d !important;
            border-radius: 0;
        }

        .navigation-item.active-nav {
            color: #03073d !important;
            border-bottom: 1px solid #03073d !important;
            border-radius: 0;
        }

        .bg-nav {
            background-color: whitesmoke;
            border-bottom: 1px solid #d8d4d4;
        }

        .semi-nav:hover {
            color: #03073d !important;
            /* border-bottom: 1px solid #03073d !important; */
            border-radius: 0;
        }

        /* .semi-nav.active-nav {
            color: #03073d !important;
            border-bottom: 1px solid #03073d !important;
            border-radius: 0;
        } */
    </style>

</head>
<body>
    <div class="container-fluid p-0 m-0">
        <div class="d-flex justify-content-between my-2">
            <a class="ms-2" href="{{ asset('dashboard') }}">
                <img src="{{ asset('logo/sealogo1.png') }}" class="img-fluid" style="max-height:90px; max-width: 250px;"
                    alt="SEA Olympus Marketing Inc. Logo" loading="lazy">
            </a>
            <div class="text-center">
                @auth
                    <div class="text-end me-2 mt-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="border border-danger rounded-4 p-1 mt-2 logout-hover">
                                <i class="bi bi-person-circle text-danger"></i>
                                <span class="fw-semibold">{{ auth()->user()->name }}</span> :
                                <span class=""> Logout</span>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
        <div class="d-flex flex-wrap gap-3 d-flex justify-content-center sticky-top bg-nav">
            @auth
                <a href="{{ route('dashboard') }}"
                    class="text-danger fw-semibold navigation-item {{ request()->routeIs('dashboard') ? 'active-nav' : '' }}">
                    <i class="bi bi-grid fs-5"></i> Dashboard
                </a>
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
                    <a href="{{ route('announcement.index') }}"
                        class="text-danger fw-semibold navigation-item {{ request()->routeIs('announcement.*') ? 'active-nav' : '' }}">
                        <i class="bi bi-megaphone fs-5"></i> Announcements
                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="text-danger fw-semibold navigation-item {{ request()->routeIs('admin.users*') ? 'active-nav' : '' }}">
                        <i class="bi bi-person-gear fs-5"></i> Manage Users
                    </a>
                @endif
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'moderator')
                    <a href="{{ route('departments.index') }}" class="text-danger fw-semibold navigation-item 
                    {{ request()->routeIs('departments.*') || request()->routeIs('employees.*') ? 'active-nav' : '' }}">
                        <i class="bi bi-building-gear fs-5"></i> Departments
                    </a>
                @endif
            @endauth
        </div>
        <div class="container-fluid rounded-1 content mt-2 m-0 p-0 mx-auto">
            @yield('content')
        </div>
        <footer class="my-4">
            <p class="text-center">&copy; Copyright of 2026 - S.E.A. Olympus Marketing Inc.</p>
        </footer>
    </div>
    <!-- Dashboard Modal -->
    <div class="modal fade" id="dashboardModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalBody"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.js')}}"></script>
</body>

</html>