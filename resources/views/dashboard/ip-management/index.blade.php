@extends('dashboard.dashboard-layout')

@section('title', 'IP Management')

@section('content')
<style>
    .sort-btn.active {
    background-color: #dc3545;
    color: white;
    }
</style>
<div class="container-fluid py-5 px-5 pt-3" style="background-color: #FFFF">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">IP Management</h2>
        <a href="{{ route('dashboard') }}" class="text-decoration-none text-secondary">
            &larr;Back to Dashboard
        </a>
    </div>

    <div class="mb-2">
        <a href="{{ route('ip.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-circle"></i> Add IP Device
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show auto-dismiss" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-1">
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-danger sort-btn" data-device="">
                        All
                    </button>
                    <button class="btn btn-outline-danger sort-btn" data-device="Laptop">
                        Laptop
                    </button>
                    <button class="btn btn-outline-danger sort-btn" data-device="Desktop">
                        Desktop
                    </button>
                    <button class="btn btn-outline-danger sort-btn" data-device="Printer">
                        Printer
                    </button>
                    <button class="btn btn-outline-danger sort-btn" data-device="Router">
                        Router
                    </button>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 ms-auto">
                    <div class="input-group">
                        <input type="text"
                            id="ipSearch"
                            class="form-control"
                            placeholder="Search IP, name, or device...">
                    </div>
                </div>
            </div>

            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>Owner</th>
                            <th>Device</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Added</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody id="ipTableBody">
                        @forelse($ips as $ip)
                        <tr>

                            <td>
                                {{ $ip->firstname }} {{ $ip->lastname }}
                            </td>

                            <td>
                                {{ $ip->device }}
                            </td>

                            <td>
                                <span class="fw-semibold">
                                    {{ $ip->ip_address }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $statusColor = match ($ip->status) {
                                        'Active' => 'success',
                                        'Inactive' => 'secondary',
                                        'Disconnected' => 'danger',
                                        'Reserved' => 'warning',
                                        default => 'secondary',
                                    };
                                @endphp

                                <span class="badge bg-{{ $statusColor }}">
                                    {{ $ip->status }}
                                </span>
                            </td>

                            <td>
                                {{ $ip->created_at->format('M d, Y') }}
                            </td>

                            <td class="text-end">

                                <a href="{{ route('ip.edit', $ip->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('ip.delete', $ip->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this IP record?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No IP devices found.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $ips->links('pagination::simple-bootstrap-5') }}
            </div>

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

    const searchInput = document.getElementById("ipSearch");
    const tableBody = document.getElementById("ipTableBody");
    const sortButtons = document.querySelectorAll(".sort-btn");

    let currentSearch = "";
    let currentDevice = "";

    function fetchData() {
        fetch(`/ip-management?search=${currentSearch}&device=${currentDevice}`)
        .then(res => res.text())
        .then(data => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(data, "text/html");
            let newBody = doc.querySelector("#ipTableBody");

            if (newBody) {
                tableBody.innerHTML = newBody.innerHTML;
            }
        });
    }

    // Search
    searchInput.addEventListener("keyup", function () {
        currentSearch = this.value;
        fetchData();
    });

    // Sort buttons
    sortButtons.forEach(btn => {
        btn.addEventListener("click", function () {

            // Active button UI
            sortButtons.forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            currentDevice = this.dataset.device;
            fetchData();
        });
    });

});
</script>

@endsection