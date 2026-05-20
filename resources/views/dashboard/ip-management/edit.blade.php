@extends('dashboard.dashboard-layout')

@section('title', 'Edit IP Device')

@section('content')
<div class="container py-5 pt-2">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit IP Device</h2>
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

            <form method="POST" action="{{ route('ip.update', $ip->id) }}" id="editIpForm">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">First Name</label>
                        <input type="text" name="firstname"
                               class="form-control"
                               value="{{ old('firstname', $ip->firstname) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Last Name</label>
                        <input type="text" name="lastname"
                               class="form-control"
                               value="{{ old('lastname', $ip->lastname) }}" required>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Device Type</label>
                        <select name="device" class="form-select" required>

                            <option value="Laptop" {{ $ip->device == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="Desktop" {{ $ip->device == 'Desktop' ? 'selected' : '' }}>Desktop</option>
                            <option value="Cellphone" {{ $ip->device == 'Cellphone' ? 'selected' : '' }}>Cellphone</option>
                            <option value="Printer" {{ $ip->device == 'Printer' ? 'selected' : '' }}>Printer</option>
                            <option value="Tablet" {{ $ip->device == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                            <option value="Other" {{ $ip->device == 'Other' ? 'selected' : '' }}>Other</option>

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">IP Address</label>
                        <input type="text"
                               name="ip_address"
                               class="form-control"
                               id="ipAddressInput"
                               value="{{ old('ip_address', $ip->ip_address) }}"
                               required>
                        <small id="ipCheckMessage"></small>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select" required>

                            <option value="Active" {{ $ip->status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $ip->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="Reserved" {{ $ip->status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                            <option value="Disconnected" {{ $ip->status == 'Disconnected' ? 'selected' : '' }}>Disconnected</option>

                        </select>
                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-danger" id="updateIpBtn">
                        <i class="bi bi-save"></i> Update IP Device
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('editIpForm');
    const submitBtn = document.getElementById('updateIpBtn');

    form.addEventListener('submit', function () {

        submitBtn.disabled = true;

        submitBtn.innerHTML =
        `<span class="spinner-border spinner-border-sm me-2"></span>Updating device...`;

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