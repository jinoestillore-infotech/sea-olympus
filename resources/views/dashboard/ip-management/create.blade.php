@extends('dashboard.dashboard-layout')

@section('title', 'Add IP Device')

@section('content')
<div class="container py-5 pt-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Add IP Device</h2>
        <a href="{{ route('ip.index') }}" class="text-decoration-none text-secondary">
            &larr; Back to IP Management
        </a>
    </div>
    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('ip.store') }}" id="createIpForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">First Name</label>
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Device Type</label>
                        <select name="device" class="form-select" required>
                            <option value="">Select Device</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Desktop">Desktop</option>
                            <option value="Cellphone">Cellphone</option>
                            <option value="Printer">Printer</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">IP Address</label>
                        <input type="text"
                            name="ip_address"
                            id="ipAddressInput"
                            class="form-control"
                            placeholder="192.168.1.10"
                            value="{{ old('ip_address') }}"
                            required>
                        <small id="ipCheckMessage"></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Reserved">Reserved</option>
                            <option value="Disconnected">Disconnected</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-danger" id="submitIpBtn">
                        <i class="bi bi-plus-circle"></i> Add IP Device
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('createIpForm');
    const submitBtn = document.getElementById('submitIpBtn');

    form.addEventListener('submit', function () {

        submitBtn.disabled = true;

        submitBtn.innerHTML =
        `<span class="spinner-border spinner-border-sm me-2"></span>Adding device...`;

    });

});

document.addEventListener("DOMContentLoaded", function(){

    const ipInput = document.getElementById("ipAddressInput");
    const message = document.getElementById("ipCheckMessage");

    function isValidIP(ip){
        const pattern = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
        return pattern.test(ip);    
    }

    ipInput.addEventListener("keyup", function(){

        let ip = this.value.trim();

        if(ip.length < 7){
            message.innerHTML = "";
            return;
        }

        if(!isValidIP(ip)){
            message.innerHTML = "❌ Invalid IP address";
            message.className = "text-danger";
            return;
        }

        fetch(`/ip-management/check-ip?ip=${ip}`)
        .then(res => res.json())
        .then(data => {

            if(data.exists){

                message.innerHTML = "⚠ IP already in use";
                message.className = "text-danger";

            }else{

                message.innerHTML = "✔ IP available";
                message.className = "text-success";

            }

        });

    });

});

</script>

@endsection