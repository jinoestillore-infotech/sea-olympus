<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.manage-users', compact('users'));
    }

    public function create()
    {
        return view('dashboard.create-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin,moderator',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        $currentUser = auth()->user();

        // Prevent deleting yourself
        if ($user->id === $currentUser->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        // Moderator cannot delete admin
        if ($currentUser->isModerator() && $user->isAdmin()) {
            return back()->with('error', 'Moderators cannot delete admins.');
        }

        if ($currentUser->isModerator() && $user->role === 'user') {
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        }

        // If deleting an admin, require predefined code
        if ($user->role === 'admin') {

            $request->validate([
                'admin_delete_code' => 'required'
            ]);

            if ($request->admin_delete_code !== config('app.admin_delete_code')) {
                return back()->with('error', 'Invalid admin deletion code.');
            }
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function __construct()
    {

        $this->middleware(function ($request, $next) {

            if (!auth()->check() || !auth()->user()->isStaff()) {
                abort(403);
            }

            return $next($request);
        });
    }


}
