<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use App\Models\BirthdayCorner;
use App\Models\CompanyHoliday;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;

class AnnouncementController extends Controller
{

    public function index()
    {
        $announcements = Announcement::latest()->simplePaginate(6);
        $upcomingHolidays = CompanyHoliday::where('date', '>=', Carbon::today())
        ->orderBy('date', 'asc')
        ->get();

        $announcement = Announcement::count();
        $users = User::count(); 

        // $holidays = $upcomingHolidays->count();
        $holidaysCount = CompanyHoliday::where('type', 'holiday')->count();
        $nonOperatingCount = CompanyHoliday::where('type', 'non_operating')->count();
        $departmentsCount = Department::count();
        $employeesCount = Employee::count();

        $announcementsList = Announcement::latest()->get();
        $usersList = User::latest()->get();
        $holidaysList = CompanyHoliday::where('type', 'holiday')->get();
        $nonOperatingList = CompanyHoliday::where('type', 'non_operating')->get();

        $departmentsList = Department::with('employees')->get(); // eager load employees
        $employeesList = Employee::with('department')->get();

        $birthdays = BirthdayCorner::with('employee')
            ->whereHas('employee', function ($query) {
                $query->where('status', 'active');
            })
            ->whereMonth('birthdate', Carbon::now()->month)
            ->orderByRaw('DAY(birthdate) ASC')
            ->get();

        return view('dashboard.index', compact('announcements', 'announcement', 'upcomingHolidays', 'users', 'holidaysCount', 'nonOperatingCount', 'announcementsList', 'usersList', 'holidaysList', 'nonOperatingList', 'departmentsCount', 'employeesCount', 'departmentsList', 'employeesList', 'birthdays'));
    }

    // Store new announcement
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', 
        ]);

        $imagePath = null;

if ($request->hasFile('image')) {

    $image = $request->file('image');
    $filename = time().'_'.$image->getClientOriginalName();

    $destination = $_SERVER['DOCUMENT_ROOT'] . '/images/announcements';

    $image->move($destination, $filename);

    $imagePath = 'images/announcements/'.$filename;
}

        Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Announcement created successfully!');
    }

    public function create()
    {
        return view('dashboard.announcement.create');
    }

    public function show(Announcement $announcement)
    {
        return view('dashboard.announcement.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        $user = auth()->user();

        // Only admin or moderator can edit
        if (!$user->isStaff()) {
            abort(403);
        }

        return view('dashboard.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $user = auth()->user();

        // Only admin or moderator can update
        if (!$user->isStaff()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

if ($request->hasFile('image')) {

        // Correct path to htdocs
        $basePath = $_SERVER['DOCUMENT_ROOT'];

        // ✅ Delete old image (correct location)
        if ($announcement->image && file_exists($basePath . '/' . $announcement->image)) {
            unlink($basePath . '/' . $announcement->image);
        }

        // ✅ Upload new image to htdocs/images/announcements
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();

        $destination = $basePath . '/images/announcements';
        $file->move($destination, $filename);

        $data['image'] = 'images/announcements/' . $filename;
    }

        $announcement->update($data);

        return redirect()->route('announcement.show', $announcement)
                        ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $user = auth()->user();

        // Only admin or moderator can delete
        if (!$user->isStaff()) {
            abort(403);
        }

        $announcement->delete();

        return redirect()->route('dashboard')->with('success', 'Announcement deleted successfully.');
    }

    public function announcementIndex()
    {
        // Fetch announcements with pagination
        $announcements = Announcement::latest()->simplePaginate(6); // Adjust pagination as needed

        // Pass announcements to the view
        return view('dashboard.announcement.index', compact('announcements'));
    }


}
