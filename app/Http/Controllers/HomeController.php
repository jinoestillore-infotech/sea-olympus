<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\BirthdayCorner;
use App\Models\CompanyHoliday;
use App\Models\Employee;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {

        $announcements = Announcement::latest()->simplePaginate(3);
        $upcomingHolidays = CompanyHoliday::where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->get();

        $birthdays = BirthdayCorner::with('employee')
            ->whereHas('employee', function ($query) {
                $query->where('status', 'active');
            })
            ->whereMonth('birthdate', Carbon::now()->month)
            ->orderByRaw('DAY(birthdate) ASC')
            ->get();

        return view('homepage.home-display', compact('announcements', 'upcomingHolidays', 'birthdays'));
    }
}
