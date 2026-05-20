<?php

namespace App\Http\Controllers;

use App\Models\BirthdayCorner;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BirthdayCornerController extends Controller
{
    public function index()
    {
        $birthdays = BirthdayCorner::with('employee.department')
            ->whereHas('employee', function ($query) {
            $query->where('status', 'active');
            })
            ->orderByRaw('MONTH(birthdate) ASC')
            ->orderByRaw('DAY(birthdate) ASC')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->birthdate)->format('F');
            });

        return view('birthday.index', compact('birthdays'));
    }

    public function create()
    {
        $employees = Employee::with('department')
            ->whereDoesntHave('birthday')
            ->where('status', 'active')
            ->get();

        return view('birthday.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'birthdate' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $filename = time() . '_' . $file->getClientOriginalName();

        // ✅ Correct path to htdocs
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/images/birthday_profiles';

        $file->move($destination, $filename);

        $imagePath = 'images/birthday_profiles/' . $filename;
    }

        BirthdayCorner::create([
            'employee_id' => $request->employee_id,
            'birthdate' => $request->birthdate,
            'profile_picture' => $imagePath
        ]);

        return redirect()->route('birthday.index')
            ->with('success', 'Employee added to Birthday Corner successfully!');
    }

    public function edit(BirthdayCorner $birthday)
    {
        $this->authorizeAccess();

        return view('birthday.edit', compact('birthday'));
    }

    public function update(Request $request, BirthdayCorner $birthday)
    {
        $this->authorizeAccess();

        $request->validate([
            'birthdate' => 'required|date',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

$basePath = $_SERVER['DOCUMENT_ROOT'];

    if ($request->hasFile('profile_picture')) {

        // ✅ Delete old image (correct path)
        if ($birthday->profile_picture && file_exists($basePath . '/' . $birthday->profile_picture)) {
            unlink($basePath . '/' . $birthday->profile_picture);
        }

        $file = $request->file('profile_picture');
        $filename = time() . '_' . $file->getClientOriginalName();

        // ✅ Save to htdocs/images/birthday_profiles
        $destination = $basePath . '/images/birthday_profiles';
        $file->move($destination, $filename);

        $birthday->profile_picture = 'images/birthday_profiles/' . $filename;
    }

        $birthday->birthdate = $request->birthdate;
        $birthday->save();

        return redirect()->route('birthday.index')->with('success', 'Birthday updated successfully.');
    }

    public function destroy(BirthdayCorner $birthday)
    {
        $this->authorizeAccess();

        $birthday->delete();

        return redirect()->back()->with('success', 'Birthday deleted successfully.');
    }

    private function authorizeAccess()
    {
        if (!in_array(auth()->user()->role, ['admin', 'moderator'])) {
            abort(403);
        }
    }
}
