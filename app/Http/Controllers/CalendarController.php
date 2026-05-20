<?php

namespace App\Http\Controllers;

use App\Models\CompanyHoliday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $holidays = CompanyHoliday::all()->keyBy(function ($item) {
            return $item->date->format('Y-m-d');
        });

        // $currentMonth = Carbon::now();
        $year = $request->query('year', now()->year);
        $month = $request->query('month', now()->month);
        $today = now()->format('Y-m-d');

        $currentMonth = Carbon::create($year, $month, 1);

        return view('dashboard.calendar.index', compact('holidays', 'currentMonth', 'today'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'moderator'])) {
            abort(403);
        }

        $request->validate([
            'date' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    // Check if any holiday or non-operating day already exists on this date
                    $existing = CompanyHoliday::where('date', $value)->first();
                    if ($existing) {
                        $fail(
                            'Cannot add a ' . ucfirst(str_replace('_',' ',$request->type)) .
                            ' on ' . \Carbon\Carbon::parse($value)->format('F d, Y') .
                            '. A ' . ucfirst(str_replace('_',' ',$existing->type)) . ' already exists.'
                        );
                    }
                }
            ],
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:holiday,non_operating'
        ]);

        CompanyHoliday::create([
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return back()->with('success', ucfirst(str_replace('_',' ', $request->type)) . ' added to the Calendar.');
    }

    public function destroy(CompanyHoliday $holiday)
    {
        if (!in_array(auth()->user()->role, ['admin', 'moderator'])) {
            abort(403);
        }
        
        $holiday->delete();

        return back()->with('success', ucfirst(str_replace('_',' ', $holiday->type)) . ' removed.');
    }

    public function update(Request $request, CompanyHoliday $holiday)
    {
        if (!in_array(auth()->user()->role, ['admin', 'moderator'])) {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date',
            'title' => 'required|string|max:255',
        ]);

        $holiday->update([
            'date' => $request->date,
            'title' => $request->title,
        ]);

    return redirect()->route('calendar.index')->with('success', ucfirst(str_replace('_',' ', $holiday->title)) . ' updated successfully.');
    }

    public function edit(CompanyHoliday $holiday)
    {
        if (!in_array(auth()->user()->role, ['admin', 'moderator'])) {
            abort(403);
        }

        return view('dashboard.calendar.edit', compact('holiday'));
    }

    public function publicIndex(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year  = $request->year ?? now()->year;
        $highlight = $request->highlight ?? null;
        $today = now()->format('Y-m-d');

        $currentMonth = \Carbon\Carbon::create($year, $month, 1);

        $holidays = CompanyHoliday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->date)->format('Y-m-d');
            });

        return view('pages.calendar-view', compact('currentMonth', 'holidays', 'highlight', 'today'));
    }


}
