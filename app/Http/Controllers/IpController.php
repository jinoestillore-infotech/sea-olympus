<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IpManagement;

class IpController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->search;
        $device = $request->device;

        $ips = IpManagement::when($search, function($query) use ($search) {

            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%{$search}%")
                  ->orWhere('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('device', 'like', "%{$search}%");
            });

        })
        ->when($device, function($query) use ($device) {
            $query->where('device', $device);
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

        return view('dashboard.ip-management.index', compact('ips'));
    }

    public function create()
    {
        return view('dashboard.ip-management.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'device' => 'required|string',
            'ip_address' => 'required|ip|unique:ip_management,ip_address',
            'status' => 'required|string'
        ]);

        IpManagement::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'device' => $request->device,
            'ip_address' => $request->ip_address,
            'status' => $request->status
        ]);

        return redirect()->route('ip.index')
            ->with('success', 'IP device added successfully.');
    }


    public function edit($id)
    {
        $ip = IpManagement::findOrFail($id);

        return view('dashboard.ip-management.edit', compact('ip'));
    }


    public function update(Request $request, $id)
    {
        $ip = IpManagement::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'device' => 'required|string',
            'ip_address' => 'required|ip|unique:ip_management,ip_address,' . $ip->id,
            'status' => 'required|string'
        ]);

        $ip->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'device' => $request->device,
            'ip_address' => $request->ip_address,
            'status' => $request->status
        ]);

        return redirect()->route('ip.index')
            ->with('success', 'IP record updated successfully.');
    }


    public function delete($id)
    {
        $ip = IpManagement::findOrFail($id);

        $ip->delete();

        return redirect()->route('ip.index')
            ->with('success', 'IP record deleted successfully.');
    }

    public function checkIp(Request $request)
    {
        $exists = IpManagement::where('ip_address', $request->ip)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }
}
